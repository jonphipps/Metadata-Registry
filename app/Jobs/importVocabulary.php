<?php

namespace App\Jobs;

use App\Models\Concept;
use App\Models\Element;
use App\Models\Import;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ImportVocabulary implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /** @var Import */
    private $import;
    /** @var Model */
    private $resource;

    /**
     * Create a new job instance.
     *
     * @param Import $import
     */
    public function __construct(Import $import)
    {
        //
        $this->import = $import;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Throwable
     * @throws \Exception
     */
    public function handle()
    {
        //start a transaction
        DB::transaction(function() {
            $vocabId   = $this->isElementSet()? $this->import->schema_id: $this->import->vocabulary_id;
            $changeset = $this->import->instructions;
            //each item in the main array is a row. Each item in the statements array is a statement
            foreach ($changeset['update'] as $reg_id => $row) {
                $statements = $this->getStatements($reg_id);
                foreach ($row as $statement) {
                    $old = $statements->find($statement['statement_id']);
                    if ($old) {
                        if ($statement['new value']) {
                            $old->update([
                                'object'         => $statement['new value'],
                                'last_import_id' => $this->import->id,
                            ]);
                        } else {
                            $old->delete();
                        }
                    } else {
                        //make a new one
                        $this->addStatement($statement, $reg_id);
                    }
                }
                $this->resource->fresh([ 'statements' ])->updateFromStatements();
            }
            foreach ($changeset['add'] as $row) {
                $resource = $this->createResource($vocabId);
                foreach ($row as $statement) {
                    $this->addStatement($statement, $resource->id);
                }
                $this->resource->fresh([ 'statements' ])->updateFromStatements();
            }
            //step through the changeset and change/add the statements
            // each row of the changeset is a resource
            //  if the row has an id then we're updating it
            //  if there's a statement id for a column, we're updating it
            // if we delete a row, we have to delete all of the statements
            //changing the statements should trigger an addition to the history table for each one
            //update each resource base model with data from the statements
        });
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

    private function createResource(int $vocabId): ?Model
    {
        if ($this->isElementSet()) {
            $this->resource = Element::create([ 'schema_id' => $vocabId ]);
        } else {
            $this->resource = Concept::create([ 'vocabulary_id' => $vocabId ]);
        }

        return $this->resource;
    }

    private function addStatement(array $statement, $reg_id)
    {
        if ($this->isElementSet()) {
            $this->resource->statements()->create([
                'object'              => $statement['new value'],
                'language'            => $statement['language'],
                'profile_property_id' => $statement['property_id'],
                'status_id'           => $this->import->elementset->status_id,
                'last_import_id'      => $this->import->id,
            ]);
        } else {
            $this->resource->statements()->create([
                'object'              => $statement['new value'],
                'language'            => $statement['language'],
                'profile_property_id' => $statement['property_id'],
                'status_id'           => $this->import->vocabulary->status_id,
                'last_import_id'      => $this->import->id,
            ]);
        }
    }

    private function isElementSet(): bool
    {
        return (bool) $this->import->schema_id;
    }
}
