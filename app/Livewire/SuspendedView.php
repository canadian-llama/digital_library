<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SuspendedView extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        // dd(!$this->user->can('visit_user'));
        if (!$this->user->can('visit_suspended') && $this->user->can('visit_user')) {
            abort(403);
        } elseif (!$this->user->can('visit_suspended') && !$this->user->can('visit_user')) {
            abort(403);
        } else {
            return view('livewire.suspended-view');
        }
    }
}
