<?php

namespace App\Livewire\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListView extends Component
{
    public $var;

    public $id;

    public $title = '';

    public $user;

    public function mount($var, $id = 1)
    {
        $this->var = $var;
        $this->id = $id;
        // dd($this->id);
        $this->user = User::findOrFail((int)$id);

        if ($this->var === 'following') {
            $this->title = 'Followers';
        } else {
            $this->title = 'Following';
        }
    }

    public function render()
    {

        if ($this->var === 'following') {
            return view('livewire.helpers.list-view', [
                'follows' => $this->user->followings
            ]);
        } else {
            return view('livewire.helpers.list-view', [
                'follows' => $this->user->followers
            ]);
        }
    }
}
