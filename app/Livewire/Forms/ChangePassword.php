<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ChangePassword extends Component
{

    public $password;
    public $password_confirmation;
    public $oldPassword;
    public $user;
    public $token;

    public function mount()
    {
        $this->user = Auth::user();
    }

    private function validator()
    {
        $rules = [
            'oldPassword' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($rules);
    }

    private function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        Toaster::success('Password Changed');
        $this->redirect('/', navigate: true);
    }

    public function save()
    {
        $this->validator();
        $currentUser = Auth::user();
        if ($currentUser) {
            $old_password = $currentUser->password;
            $isMatch = Hash::check($this->oldPassword, $old_password);
            $isSame = Hash::check($this->password, $old_password);
            $newPassword = Hash::make($this->password);
            // dd($isMatch && !$isSame);
            if ($isMatch && !$isSame) {
                $user = User::findOrFail($currentUser->id);
                // dd($user);
                $user->update([
                    'password' => $newPassword
                ]);
                $this->logout();
            } else {
                Toaster::error('Password cannot be same with old password');
            }
        }
    }

    public function render()
    {
        return view('livewire.forms.change-password');
    }
}
