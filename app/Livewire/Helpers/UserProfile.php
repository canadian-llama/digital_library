<?php

namespace App\Livewire\Helpers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class UserProfile extends Component
{
    use WithFileUploads;

    public $user;
    public $username;
    public $email;
    public $bio;
    public $image;

    public function mount()
    {
        $this->user = Auth::user();
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->bio = $this->user->bio;
        $this->image = $this->user->profile_image;
    }

    private function validator()
    {
        $rules = [
            'username' => '',
            'email' => '',
            'bio' => '',
            'image' => ''
        ];
        if ($this->username) {
            if ($this->username === Auth::user()->username) {
                $rules['username'] = 'required|string';
            } else {
                $rules['username'] = 'required|string|unique:users';
            }
        } elseif ($this->email) {
            $rules['email'] = 'required|string|unique:users';
        } elseif ($this->bio) {
            $rules['bio'] = 'nullable|string|max:255';
        } elseif ($this->image) {
            $rules['image'] = 'nullable|file|max:100000|mimes:png,jpg,webp';
        }

        return $this->validate($rules);
    }

    private function uploadProfileImage(User $user)
    {
        // if (!$this->image instanceof TemporaryUploadedFile) {
        //     Toaster::error('Image not Uploaded');
        //     return $this->image = $user->profile_image;
        // }
        try {
            if(!$this->image instanceof TemporaryUploadedFile) {
                Toaster::error('Image not Uploaded');
                return $this->image = $user->profile_image;
                // throw new  Exception('Image Book File is not ready or Invalid.');
            }
            return Storage::disk('public')->put('profile_images', $this->image);
        } catch (Exception $e) {
            Log::error('Image Upload Failed:' . $e->getMessage());
            return null;
        }
    }

    public function update(User $user)
    {
        $this->validator();
        // dd($valid);
        $this->image = $this->uploadProfileImage($user) ?? $this->user->profile_image;

        $user->update([
            'username' => $this->username,
            'bio' => $this->bio,
            'email' => $this->email,
            'profile_image' => $this->image,
        ]);
        Toaster::success('Profile Updated');
        $this->reset(['image']);
    }

    public function changePassword()
    {
        dd('password-change');
    }

    public function deactivate()
    {
        dd('deactivate');
    }

    public function softDelete()
    {
        dd('Delete');
    }

    public function render()
    {
        return view('livewire.helpers.user-profile');
    }
}
