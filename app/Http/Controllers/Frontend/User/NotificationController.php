<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    public function all()
    {
        return auth()->user()->notifications;
    }

    public function unread()
    {
        return auth()->user()->unreadNotifications()->get();
    }

    public function delete(DatabaseNotification $notification)
    {
        return $notification->save(['read_at' => Carbon::now()]);
    }

    public function show(DatabaseNotification $notification)
    {
        return $notification;
    }
}
