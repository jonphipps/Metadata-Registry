<?php

namespace App\Notifications\Frontend;

use App\Models\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportWasCompleted extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * @var Batch
     */
    public $batch;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Batch $batch)
    {
        $this->batch = $batch;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your vocabularies have been imported.')
            ->action('View Report', url("/projects/{$this->batch->project->id}/imports/{$this->batch->id}/results"))
            ->line('Thank you for using the Open Metadata Registry!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
