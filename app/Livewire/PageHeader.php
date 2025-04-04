<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PageHeader extends Component
{
    // public $title;

    // public function mount ($title){
    //     $this->$title = $title;
    // }

    public function logout()
    {

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        Toaster::success('User Logged Out Successfully');
        return $this->redirect('/', navigate:true);
    }


    public function render()
    {
        return view('livewire.page-header');
    }
}
