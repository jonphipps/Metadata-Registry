<?php

namespace App\Jobs;

use App\Models\Batch;
use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Element;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class UpdateRelatedIds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Batch
     */
    private $batch;

    /**
     * Create a new job instance.
     *
     * @param Batch $batch
     */
    public function __construct(Batch $batch)
    {
        //
        $this->batch = $batch;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            foreach ($this->batch->imports as $import) {
                $statements = $import->conceptResourceStatements()->where('related_concept_id', null);
                /** @var ConceptAttribute[] $statements */
                if ($statements->count()) {
                    foreach ($statements as $statement) {
                        $concept = Concept::where('uri', $statement->object)->first();
                        if ($concept) {
                            $statement->update([ 'related_concept_id' => $concept->id ]);
                        }
                    }
                }
                $statements = $import->elementResourceStatements()->where('related_schema_property_id', null);
                /** @var ConceptAttribute[] $statements */
                if ($statements->count()) {
                    foreach ($statements as $statement) {
                        $element = Element::where('uri', $statement->object)->first();
                        if ($element) {
                            $statement->update([ 'related_schema_property_id' => $element->id ]);
                        }
                    }
                }
            }
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
        }

    }
}
