<?php

namespace App\Jobs;

use App\Events\ImportFailed;
use App\Events\ImportFinished;
use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\Import;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use MailThief\Message;

class ImportVocabulary implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /** @var Import */
    private $import;
    /** @var Model */
    private $resource;
    /** @var Collection */
    private $formResourceProps;
    /** @var Collection */
    private $formLanguageProps;
    /** @var string */
    private $resourceLang;
    /** @var array */
    private $updatedStatements;
    /** @var array */
    private $results;
    /** @var int */
    private $userId;

    /**
     * Create a new job instance.
     *
     * @param int $importId
     */
    public function __construct(int $importId)
    {
        $this->import = Import::find($importId);
    }

    /**
     * Execute the job.
     *   step through the changeset and change/add the statements
     *   each row of the changeset is a resource
     *   if the row has an id then we're updating it
     *   if there's a statement id for a column, we're updating it
     *   if we delete a row, we have to delete all of the statements
     *   changing the statements should trigger an addition to the history table for each one
     *   update each resource base model with data from the statements.
     *
     * @return void
     * @throws \Throwable
     * @throws \Exception
     */
    public function handle()
    {
        $timer           = new \DateTime();
        $this->setFormproperties();
        $this->setLanguage();
        $this->userId    = $this->import->user_id;
        $vocabId         = $this->isElementSet() ? $this->import->schema_id : $this->import->vocabulary_id;
        $changeset       = $this->import->instructions;
        $total_processed = 0;
        $added           = 0;
        $updated         = 0;
        $deleted         = 0;
        //each item in the main array is a row. Each item in the statements array is a statement
        foreach ($changeset['update'] as $reg_id => $row) {
            $this->updatedStatements = [];
            //start a transaction
            DB::transaction(function () use ($reg_id, $row, &$updated) {
                $statements = $this->getStatements($reg_id);
                $dirty = false;
                foreach ($row as $statement) {
                    $old = $statements->find($statement['statement_id']);
                    if ($old) {
                        if ($statement['new value']) {
                            $old->update([
                                'object'         => $statement['new value'],
                                'last_import_id' => $this->import->id,
                                'is_generated'   => false,
                            ]);
                            $this->addUpdateStatement($statement);
                            $dirty = true;
                        } else {
                            $old->delete();
                            $this->addUpdateStatement($statement);
                            $dirty = true;
                        }
                    } else {
                        //make a new one
                        $existingStatement = $statements->filter(function ($item) use ($statement) {
                            /* @var Model $item */
                            return $item->profile_property_id == $statement['property_id'] &&
                                $item->object == $statement['new value'] &&
                                $item->getOriginal('language') === $statement['language'];
                        });
                        if ($existingStatement->count() === 0) {
                            $newStatement = $this->makeStatement($statement);
                            $this->resource->statements()->save($newStatement);
                            $this->addUpdateStatement($statement);
                            $dirty = true;
                        }
                    }
                }
                if (\count($this->updatedStatements)) {
                    try {
                        $this->resource->updated_user_id = $this->userId;
                        $this->resource->updateFromStatements($this->updatedStatements);
                    } catch (Exception $e) {
                        //log the error
                        $this->makeErrorLogEntry($row['*uri']['new value'], $e->getMessage());
                        //cancel the transaction
                        return false;
                    }
                }
                if ($dirty) {
                    $updated++;
                }
            });
            $total_processed++;
        }
        foreach ($changeset['add'] as $row) {
            DB::transaction(function () use ($row, $vocabId, &$added) {
                $allStatements = [];
                foreach ($row as $statement) {
                    $this->addUpdateStatement($statement);
                    $allStatements[] = $this->makeStatement($statement);
                }
                try {
                    //this will make a resource with insufficient values...
                    $resource = $this->makeResource($vocabId);
                    //this will update the resource from the statements and save it...
                    $resource->updateFromStatements($this->updatedStatements);
                    //this will add the statements...
                    $resource->statements()->saveMany($allStatements);
                    $this->UpdatePrefLabelId($resource);
                } catch (Exception $e) {
                    //log the error
                    $this->makeErrorLogEntry($row['*uri']['new value'], $e->getMessage());
                    //cancel the transaction
                    return false;
                }

                $added++;
            });
            $total_processed++;
        }
        foreach ($changeset['delete'] as $row) {
            //TODO implement this...
            //delete the resource
            //cascade delete the statements, which should cascade delete the reciprocals
            $total_processed++;
            $deleted++;
        }
        $this->setResults('timer', $timer->diff(new \DateTime())->format('%h hours; %i minutes; %s seconds'));
        $this->import->results = $this->results;
        //$this->import->batch->increment('handled_count');
        $this->import->total_processed_count = $total_processed;
        $this->import->added_count           = $added;
        $this->import->updated_count         = $updated;
        $this->import->deleted_count         = $deleted;
        $this->import->imported_at           = new \DateTime();
        $this->import->save();

        event(new ImportFinished($this->import));
    }

    public function failed(Exception $exception)
    {
        event(new ImportFailed($this->import, $exception));
    }

    private function addUpdateStatement($statement): void
    {
        if ($this->formLanguageProps->contains($statement['property_id']) &&
            $this->resourceLang === $statement['language']) {
            $this->updatedStatements[$statement['property_id']] = $statement['new value'];
        }
        if ($this->formResourceProps->contains($statement['property_id'])) {
            $this->updatedStatements[$statement['property_id']] = $statement['new value'];
        }
    }

    private function getStatements(int $reg_id): ?Collection
    {
        if ($this->isElementSet()) {
            $this->resource = Element::find($reg_id)->load('statements');
        } else {
            $this->resource = Concept::find($reg_id)->load('statements');
        }

        return $this->resource->statements;
    }

    private function setFormproperties(): void
    {
        $this->formResourceProps =
            $this->isElementSet() ? $this->import->elementset->profile->profile_properties()->where([
                ['is_in_form', true],
                ['has_language', false],
            ])->get(['id'])->pluck('id') : $this->import->vocabulary->profile->profile_properties()->where([
                ['is_in_form', true],
                ['has_language', false],
            ])->get(['id'])->pluck('id');
        $this->formLanguageProps =
            $this->isElementSet() ? $this->import->elementset->profile->profile_properties()->where([
                ['is_in_form', true],
                ['has_language', true],
            ])->get(['id'])->pluck('id') : $this->import->vocabulary->profile->profile_properties()->where([
                ['is_in_form', true],
                ['has_language', true],
            ])->get(['id'])->pluck('id');
    }

    private function setLanguage(): void
    {
        $this->resourceLang =
            $this->isElementSet() ? $this->import->elementset->getOriginal('language') : $this->import->vocabulary->getOriginal('language');
    }

    private function makeResource(int $vocabId): ?Model
    {
        if ($this->isElementSet()) {
            $this->resource = Element::make(['schema_id' => $vocabId]);
        } else {
            $this->resource = Concept::make(['vocabulary_id' => $vocabId]);
        }

        $this->resource->created_user_id = $this->userId;
        $this->resource->updated_user_id = $this->userId;

        return $this->resource;
    }

    private function makeStatement(array $statement)
    {
        $values = [
            'object'              => $statement['new value'],
            'language'            => $statement['language'],
            'profile_property_id' => $statement['property_id'],
            'last_import_id'      => $this->import->id,
            'created_user_id'     => $this->userId,
            'updated_user_id'     => $this->userId,
        ];
        if ($this->isElementSet()) {
            $values['status_id'] = $this->import->elementset->status_id;

            return ElementAttribute::make($values);
        }

        $values['status_id'] = $this->import->vocabulary->status_id;

        return ConceptAttribute::make($values);
    }

    private function UpdatePrefLabelId(Model $resource)
    {
        if (! $this->isElementSet()) {
            $id = $resource->statements()
                ->where([
                    ['profile_property_id', 45],
                    ['language', $this->resourceLang],
                ])->pluck('id');
            $resource->pref_label_id = $id[0] ?? null;
            $resource->save();
        }
    }

    private function isElementSet(): bool
    {
        return (bool) $this->import->schema_id;
    }

    private function setResults($element, $value)
    {
        $this->results[$element][] = $value;
    }

    private function makeErrorLogEntry($rowId, $message)
    {
        $this->setResults('errors', ['row'=> $rowId, 'message' =>$message]);
    }
}
