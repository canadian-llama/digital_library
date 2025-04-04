<?php

namespace App\Livewire\Helpers;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public $user;

    public function mount(){
        $this->user = Auth::user();

    }

    public function render()
    {
        return view('livewire.helpers.notifications', [
            'notifications' => $this->user->notifications
        ]);
    }
}
