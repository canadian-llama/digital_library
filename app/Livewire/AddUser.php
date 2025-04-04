<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class AddUser extends Component
{
    #[Validate('required|string')]
    public $name;

    #[Validate('required|email|unique:users')]
    public $email;

    #[Validate('required|string|unique:users')]
    public $username;

    #[Validate('required|min:8|confirmed')]
    public $password;

    public $password_confirmation;

    // #[Validate('required|in:admin,user')]
    // public $role;

    public function save(){
        $this->validate();

        User::create(
            $this->only(['name', 'email', 'username', 'password'])
        );

        Toaster::success('User added successfully');
        $this->reset(['name', 'email', 'username', 'password', 'password_confirmation']);
        $this->dispatch('$refresh');

    }



    public function render()
    {
        return view('livewire.add-user');
    }
}
