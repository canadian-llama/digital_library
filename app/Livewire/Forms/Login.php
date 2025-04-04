<?php

namespace App\Livewire\Forms;

use App\Events\NotificationSystem;
use App\Listeners\SendNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Login extends Component
{
    #[Validate('required|string')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

    public $remember;

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            $user = Auth::user();
            event(new NotificationSystem('Login Successful', Auth::user()->id, 'login'));
            Toaster::success('Welcome ' . Auth::user()->username);
            if($user->suspended === 1){
                return $this->redirect('/user/suspended', navigate:true);
            }
            return $this->redirect('/', navigate:true);
        }
        throw ValidationException::withMessages([
            'email' => 'Incorrect E-mail or Password'
        ]);
    }
    public function render()
    {
        return view('livewire.forms.login');
    }
}
