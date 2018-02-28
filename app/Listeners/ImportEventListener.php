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
    public function onImportFinished($event): void
    {
        /** @var Batch $batch */
        $batch                = $event->import->batch;
        $handled              = $batch->handled_array ?? [];
        $handled['import']    = empty($handled['import']) ? 1 : ++$handled['import'];
        $batch->handled_array = $handled;
        $batch->save();

        /** @var Import $import */
        $import = $event->import;
        \Log::info('Import Finished: ' . $import->source_file_name);

        if ($batch->total_count <= $handled['import']) {
            // we're done
            event(new BatchImportFinished($batch));
        }
    }

    /**
     * @param $event
     */
    public function onBatchImportFinished($event): void
    {
        /** @var Batch $batch */
        $batch = $event->batch;
        \Log::info('Import Parse Batch Finished: ' . $batch->run_description);

        if ($batch->user) {
            $batch->user->notify(new ImportWasCompleted($batch));
        }
    }

    /**
     * @param $event
     */
    public function onImportParseFinished($event): void
    {
        /** @var Batch $batch */
        $batch                = $event->import->batch;
        $handled              = $batch->handled_array ?? [];
        $handled['parse']     = empty($handled['parse']) ? 1 : ++$handled['parse'];
        $batch->handled_array = $handled;
        $batch->save();

        /** @var Import $import */
        $import = $event->import;
        \Log::info('Import Parse Finished: ' . $import->source_file_name);

        if ($batch->total_count <= $handled['parse']) {
            // we're done
            event(new BatchImportParseFinished($batch));
        }
    }

    /**
     * @param $event
     */
    public function onBatchImportParseFinished($event): void
    {
        /** @var Batch $batch */
        $batch = $event->batch;
        \Log::info('Import Parse Batch Finished: ' . $batch->run_description);

        if ($batch->user) {
            $batch->user->notify(new ImportEvaluationWasCompleted($batch));
        }
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
