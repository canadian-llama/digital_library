<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateUser extends Component
{
    
    #[Rule('required|string|max:255')]
    public $fullname;

    #[Rule('required|string|unique:users|max:50')]
    public $username;

    #[Rule('required|email|unique:users')]
    public $email;

    #[Rule('required|string|min:8|confirmed')]
    public $password;

    public $password_confirmation;

    #[Rule('required|in:admin,user')]
    public $role;

    public function save()
    {
        // dd(Auth::user()->role === 'admin');
        if (Auth::user()->role === 'admin') {
            $this->validate();
            User::create([
                'name' => $this->fullname,
                'username' => $this->username,
                'password' => $this->password,
                'email' =>$this->email,
                'role' => $this->role,
            ]);
            $this->redirect('/admin-dashboard', navigate:true);
        }
        $this->redirect('/admin-dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
