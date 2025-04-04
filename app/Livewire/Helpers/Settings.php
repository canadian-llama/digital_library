<?php

namespace App\Livewire\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Settings extends Component
{
    public $user;

    #[Rule('required|string')]
    public $theme;

    #[Rule('required|string')]
    public $font;

    public $setting;

    public $settingToUpdate;

    public function save()
    {
        $this->validate();

        $this->user = Auth::user();

        if ($this->user->setting !== null) {
            $this->setting = $this->user->setting->where('user_id', $this->user->id)->get();
            // dd($this->setting);
            if ($this->setting->isEmpty()) {
                Setting::create([
                    'user_id' => $this->user->id,
                    'theme' => $this->theme,
                    'font' => $this->font
                ]);
                Toaster::success('Settings Saved');
            } else {
                $this->settingToUpdate = Setting::findOrFail($this->user->setting->id);
                $this->settingToUpdate->update([
                    'theme' => $this->theme,
                    'font' => $this->font
                ]);
                Toaster::success('Settings Changed Successfully');
            }
        } else {
            Setting::create([
                'user_id' => $this->user->id,
                'theme' => $this->theme,
                'font' => $this->font
            ]);
            Toaster::success('Settings Saved');
        }
    }

    public function deactivate(){
    }

    public function delete(){}


    public function render()
    {
        return view('livewire.helpers.settings');
    }
}
