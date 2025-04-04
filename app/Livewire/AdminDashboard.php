<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class AdminDashboard extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        Toaster::success('User Logged Out Successfully');
        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        if (!$this->user->can('visit_admin')) {
            abort(403);
        }
        return view('livewire.admin-dashboard');
    }
}
