<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class ViewUser extends Component
{
    use WithPagination, WithoutUrlPagination;

    // public UserForm $form;

    public $count = 0;
    public $query = '';

    #[Validate('required|string')]
    public $name;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|in:admin,user')]
    public $role;

    #[Validate('required|string')]
    public $username;

    public $suspended;

    public $theUser;

    public User $selectedUser;

    public function viewUser(User $user){
        $this->selectedUser = $user;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->name = $user->name;
        $this->role = $user->role;
    }

    public function update(User $user){
        $this->validate();

        $user->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        Toaster::success('User Updated Sucessfully');

        $this->dispatch('close-modal', name:'modal');
    }

    private function suspend(User $user){
        $suspendedUser = $user;
        return $suspendedUser;
    }

    public function suspendUser(User $user){
        if($user->suspended != 1){
            $user->update([
                'suspended' => 1
            ]);
            Toaster::success('User Suspended');
        }else{
            $user->update([
                'suspended' => 0
            ]);
            Toaster::success('User UnSuspended');
        }
    }

    public function deactivateUser(User $user)
    {
        // dd($this->theUser);
        if ($user->deactivated != 1) {
            $user->update([
                'deactivated' => 1
            ]);
            Toaster::success('User Deactivated');
        } else {
            $user->update([
                'deactivated' => 0
            ]);
            Toaster::success('User ReActivated');
        }
    }


    public function delete(User $user) {
        $user->delete();
        Toaster::success('User Deleted Sucessfully');
    }

    

    public function render()
    {
        if($this->query){
            return view('livewire.view-user', [
                'users' => User::where('name', 'like', '%'.$this->query.'%')->paginate(10)
            ]);}
        return view('livewire.view-user', [
            'users' => User::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
