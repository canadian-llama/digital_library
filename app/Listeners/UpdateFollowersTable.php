<?php

namespace App\Listeners;

use App\Events\FollowSystem;
use App\Models\Followers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateFollowersTable
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
            $followers = Followers::where('user_id', $event->userid)->where('follower_id', $event->followerid)->get();
            if ($followers->isEmpty() && $event->followerid !== $event->userid) {
                Followers::create([
                    'user_id' => $event->userid,
                    'follower_id' => $event->followerid,
                ]);
            }
        } else {
            Followers::where('user_id', $event->userid)->where('follower_id', $event->followerid)->delete();
        }
    }
}
