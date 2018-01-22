<?php

namespace App\Notifications\Frontend;

use App\Models\Release;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReleaseWasPublished extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * @var Release
     */
    public $release;

    /**
     * Create a new notification instance.
     *
     * @param Release $release
     */
    public function __construct(Release $release)
    {
        //
        $this->release = $release;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line("Your release has been published as {$this->release->tag_name}. You can view it on GitHub or download a zip file")
                    ->action('View the Release', url("/projects/{$this->release->project->id}/releases/{$this->release->id}"))
                    ->line('Thank you for using the Open Metadata Registry!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'message' => 'Your vocabulary has been published',
        ];
    }
}
