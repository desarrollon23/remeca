<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    public function addNew(){
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser(){
        $validateData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();
        $validateData['password'] = bcrypt($validateData['password']);
        User::create($validateData);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Usuario creado correctamente!']);
    }

    public function edit(User $user){
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser(){
        $validateData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();
        if(!empty($validateData['password'])){
            $validateData['password'] = bcrypt($validateData['password']);
        }
        $this->user->update($validateData);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Datos de Usuario modificados correctamente!']);
    }

    public function confirmUserRemoval($userId){
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser(){
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Usuario Eliminado!']);
    }

    public function render()
    {
        /* $users = User::latest()->paginate(); */
        $users = User::all();
        return view('livewire.admin.users.list-users', ['users'=>$users,]);
    }
}
