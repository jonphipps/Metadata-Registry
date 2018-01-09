<?php

namespace App\Listeners;

use App\Events\BatchImportFinished;
use App\Events\BatchImportParseFinished;
use App\Events\ImportFinished;
use App\Events\ImportParseFinished;
use App\Models\Batch;
use App\Models\Import;
use App\Notifications\Frontend\ImportEvaluationWasCompleted;
use App\Notifications\Frontend\ImportWasCompleted;

/**
 * Class UserEventListener.
 */
class ImportEventListener
{

    /**
     * @param $event
     */
    public function onImportFinished($event)
    {
        /** @var Batch $batch */
        $batch = $event->import->batch;
        $handled = $batch->handled_array;
        $handled['import'] = $handled['import'] === null ? 1 : ++$handled['import'];
        $batch->handled_array = $handled;
        $batch->save();

        if ($batch->imports->count() <= $handled['import']) {
            // we're done
            event(new BatchImportFinished($batch));
        }
        /** @var Import $import */
        $import = $event->import;
        \Log::info('Import Finished: ' . $import->source_file_name);
    }

    /**
     * @param $event
     */
    public function onBatchImportFinished($event)
    {
        /** @var Batch $batch */
        $batch = $event->batch;
        if($batch->user){
            $batch->user->notify(new ImportWasCompleted($batch));
        }
        \Log::info('Import Parse Batch Finished: ' . $batch->run_description);
    }

    /**
     * @param $event
     */
    public function onImportParseFinished($event)
    {
        /** @var Batch $batch */
        $batch             = $event->import->batch;
        $handled           = $batch->handled_array;
        $handled['parse'] = $handled['parse'] === null ? 1 : ++$handled['parse'];
        $batch->handled_array = $handled;
        $batch->save();

        if ($batch->imports->count() <= $handled['parse']) {
            // we're done
            event(new BatchImportParseFinished($batch));
        }
        /** @var Import $import */
        $import = $event->import;
        \Log::info('Import Parse Finished: ' . $import->source_file_name);
    }

    /**
     * @param $event
     */
    public function onBatchImportParseFinished($event)
    {
        /** @var Batch $batch */
        $batch = $event->batch;
        if ($batch->user) {
            $batch->user->notify(new ImportEvaluationWasCompleted($batch));
        }
        \Log::info('Import Parse Batch Finished: ' . $batch->run_description);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(ImportFinished::class, 'App\Listeners\ImportEventListener@onImportFinished');
        $events->listen(ImportParseFinished::class, 'App\Listeners\ImportEventListener@onImportParseFinished');
        $events->listen(BatchImportFinished::class, 'App\Listeners\ImportEventListener@onBatchImportFinished');
        $events->listen(BatchImportParseFinished::class, 'App\Listeners\ImportEventListener@onBatchImportParseFinished');
    }
}
