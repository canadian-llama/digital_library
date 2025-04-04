<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MyLibrary extends Component
{
    public $user;

    public function mount(){
        $this->user = Auth::user();
    }

    #[Layout('components.layouts.layout ')]
    public function render()
    {
        return view('livewire.my-library', [
            'favorites' => $this->user->favourites
        ]);
    }
}
