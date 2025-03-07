<?php

namespace App\Listeners;

use App\Events\FollowSystem;
use App\Models\Following;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateFollowingsTable
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
    public function handle(FollowSystem $event): void
    {
        if ($event->var === 'follow') {
            $followings = Following::where('user_id', $event->followerid)->where('following_id', $event->userid)->get();
            if ($followings->isEmpty() && $event->followerid !== $event->userid) {
                Following::create([
                    'user_id' => $event->followerid,
                    'following_id' => $event->userid,
                ]);
            }
        } else {
            // dd('allowed');
            Following::where('user_id', $event->followerid)->where('following_id', $event->userid)->delete();
        }
    }
}
