<?php

namespace App\Listeners;

use App\Events\FollowSystem;
use App\Models\Followers;
use App\Models\Following;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        $followee = User::findOrFail($event->followerid);

        $followed = User::findOrFail($event->userid);

        // dd($followed->followings);

        $followers = Followers::where('user_id', $event->followerid)->where('follower_id', $event->userid)->get();
        $followings = Following::where('user_id', $event->userid)->where('following_id', $event->followerid)->get();

        if ($followers->isEmpty()  && $followings->isEmpty() && $event->followerid !== $event->userid) {
            Followers::create([
                'user_id' => $event->followerid,
                'follower_id' => $event->userid,
            ]);
            Following::create([
                'user_id' => $event->userid,
                'following_id' => $event->followerid,
            ]);
            $followed->update([
                'followed' => count($followed->followings)
            ]);
            $followee->update([
                'following' => count($followee->followers)
            ]);
        } else {
            Followers::where('user_id', $event->followerid)->where('follower_id', $event->userid)->delete();
            Following::where('user_id', $event->userid)->where('following_id', $event->followerid)->delete();
            $followed->update([
                'followed' => count($followed->followings)
            ]);
            $followee->update([
                'following' => count($followee->followers)
            ]);
        }
    }
}
