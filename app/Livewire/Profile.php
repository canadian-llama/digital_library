<?php

namespace App\Livewire;

use App\Events\FollowSystem;
use App\Models\Followers;
use App\Models\Following;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Profile extends Component
{
    public $user;
    public $followed;
    public function mount($id)
    {
        $this->user = User::findOrFail($id);
        // dd($this->user);
        $this->followed = Following::where('following_id', Auth::user()->id)->get();
    }

    public function follow($userid, $followerid)
    {
        // dd($userid, $followerid);
        $followers = Followers::where('user_id', $followerid)->where('follower_id', $userid)->get();
        $followings = Following::where('user_id', $userid)->where('following_id', $followerid)->get();

        if ($followers->isEmpty() && $followings->isEmpty()) {
            event(new FollowSystem($userid, $followerid));
            return $this->redirect('/profile/' . $this->user->id, navigate: true);
        } else {
            // dd('else');
            event(new FollowSystem($userid, $followerid));
            return $this->redirect('/profile/' . $this->user->id, navigate: true);
        }
    }

    #[Layout('components.layouts.headerless')]
    public function render()
    {
        if ($this->user->deactivated == 1 || $this->user->suspended == 1) {
            abort(403);
        } else {
            return view('livewire.profile');
        }
    }
}
