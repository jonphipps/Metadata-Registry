<?php

namespace App\Events;

use App\Models\Batch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BatchImportFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Batch
     */
    public $batch;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Batch $batch)
    {
        //
        $this->batch = $batch;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
