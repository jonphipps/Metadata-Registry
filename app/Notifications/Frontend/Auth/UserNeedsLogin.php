<?php

namespace App\Notifications\Frontend\Auth;

use App\Models\Access\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use PhpParser\Node\Expr\Instanceof_;

/**
 * Class UserNeedsPasswordReset
 *
 * @package App\Notifications\Frontend\Auth
 */
class UserNeedsLogin extends Notification
{

  use Queueable;

  public $users;


  /**
   * Get the notification's channels.
   *
   * @param  mixed $notifiable
   *
   * @return array|string
   */
  public function via($notifiable)
  {
    return [ 'mail' ];
  }


  /**
   * Build the mail representation of the notification.
   *
   * @param  User|\Collection $notifiable
   *
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
    $this->users = User::where('email', $notifiable->email)
                       ->get();

    $message = ( new MailMessage )->subject(app_name() . ': ' . trans('strings.emails.auth.login_name_subject'))
                                  ->line(trans('strings.emails.auth.login_name_cause_of_email'));
    if ($this->users->count() === 1) {
      $message->line(trans('strings.emails.auth.login_name_list'))
              ->line($notifiable->name);
    } else {
      $count = 0;
      /** @var \Collection $notifiable */
      $message->line(trans('strings.emails.auth.login_names_list'));
      foreach ($this->users as $login) {
        $message->line(++$count . ':   ' . $login->name);
      }
    }

    $message->action(trans('buttons.emails.auth.login'), route('frontend.auth.login'))
            ->line(trans('strings.emails.auth.login_name_if_not_requested'));

    return $message;
  }

}
