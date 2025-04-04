<?php

namespace App\Listeners;

use App\Events\NotificationSystem;
use App\Models\Followers;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use PHPUnit\Event\UnknownEventException;
use Psy\Readline\Hoa\EventException;

class SendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NotificationSystem $event): void
    {
        if($event->type === 'login'){
            Notifications::create([
                'user_id' => $event->id,
                'type' => $event->type,
                'message' => $event->message
            ]);
        }
        elseif ($event->type === 'logout') {
            Notifications::create([
                'user_id' => $event->id,
                'type' => $event->type,
                'message' => $event->message
            ]);
        } elseif ($event->type === 'comment') {
            Notifications::create([
                'user_id' => $event->id,
                'type' => $event->type,
                'message' => $event->message
            ]);
        } elseif ($event->type === 'follow') {
            Notifications::create([
                'user_id' => $event->id,
                'type' => $event->type,
                'message' => $event->message
            ]);
        } elseif ($event->type === 'favorite') {
            Notifications::create([
                'user_id' => $event->id,
                'type' => $event->type,
                'message' => $event->message
            ]);
        } elseif ($event->type === 'account_update') {
            Notifications::create([
                'user_id' => $event->id,
                'type' => $event->type,
                'message' => $event->message
            ]);
        }else{
            dd('error');
        }

    }
}
