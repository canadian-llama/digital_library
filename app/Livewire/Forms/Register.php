<?php

namespace App\Livewire\Forms;

use App\Events\NotificationSystem;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Register extends Component
{
    #[Validate('required|string|max:80')]
    public $name;

    #[Validate('required|string|max:80|unique:users')]
    public $username;

    #[Validate('required|email|unique:users')]
    public $email;

    #[Validate('required|min:8|confirmed')]
    public $password;

    public $password_confirmation;

    public function register()
    {
        $this->validate();

        $user = User::create(
            $this->only(['name', 'email', 'username', 'password'])
        );

        Auth::login($user);

        // event(new Registered($user));
        event(new NotificationSystem('Registration Successful', Auth::user()->id, 'login'));
        Toaster::success('Welcome ' . Auth::user()->username);
        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.forms.register');
    }
}
