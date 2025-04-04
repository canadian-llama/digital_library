<?php

namespace App\Livewire\Helpers;

use App\Models\Followers;
use App\Models\User;
use Livewire\Component;

class FollowersView extends Component
{
    public $title = 'Followers';
    public $id;
    public $user;

    public function mount($id)
    {
        $this->id = $id;
        $this->user = Followers::where('follower_id', $id)->get();
    }

    public function render()
    {
        return view('livewire.helpers.followers-view', [
            'followers' => $this->user
        ]);
    }
}
