<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    #[Validate('required|string')]
    public $updated_name;

    #[Validate('required|email|unique:users')]
    public $updated_email;

    #[Validate('required|string|unique:users')]
    public $updated_username;

    #[Validate('required|in:admin,user')]
    public $updated_role;

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function store()
    {
        $this->validate();

        User::create($this->all());
    }

    public function update(){
        $this->validate();

        $this->user->update(
            $this->all()
        );
    }
}
