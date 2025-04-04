<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeactivatedView extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }
    
    public function render()
    {
        if (!$this->user->can('visit_deactivated') && $this->user->can('visit_user')) {
            abort(403);
        } elseif (!$this->user->can('visit_deactivated') && !$this->user->can('visit_user')) {
            abort(403);
        } else {
            return view('livewire.deactivated-view');
        }
    }
}
