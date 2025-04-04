<?php

namespace App\Livewire\Dashboards;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UserDashboard extends Component
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
        if (!$this->user->can('visit_user')) {
            abort(403);
        }
        return view('livewire.dashboards.user-dashboard');
    }
}
