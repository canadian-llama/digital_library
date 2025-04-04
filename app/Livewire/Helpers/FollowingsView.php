<?php

namespace App\Livewire\Helpers;

use App\Models\Following;
use App\Models\User;
use Livewire\Component;

class FollowingsView extends Component
{
    public $id;
    public $user;
    public $title = 'Followings';


    public function mount($id){
        $this->id = $id;
        $this->user = Following::where('following_id', $id)->get();

    }

    public function render()
    {
        return view('livewire.helpers.followings-view', [
            'followings' => $this->user
        ]);
    }
}
