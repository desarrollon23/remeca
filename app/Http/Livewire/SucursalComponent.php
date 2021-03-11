<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sucursal;
use Livewire\WithPagination;

class SucursalComponent extends Component
{    /* public $contar;
    public $titulo, $descripcion;

    public function mount($data){ 
        $this->titulo = $data['titulo'];
        $this->descripcion = $data['descripcion']; 
    } */

    use WithPagination;

    public $descripcion, $direccion, $sucursal_id;
    public $accion = "store";
    protected $rules = [
        'descripcion' => 'required',
        'direccion' => 'required'
    ];

    protected $validationattributs = [
        'descripcion' => 'Descripción',
        'direccion' => 'Dirección'
    ];

    protected $messages = [
        'descripcion.required' => 'Por favor ingrese la Descripción.',
        'descripcion.max' => 'La Descripción no puede tener más de 45 caracteres.',
        'direccion.required' => 'Por favor ingrese la Dirección.',
        'direccion.max' => 'La Dirección no puede tener más de 100 caracteres.'
    ];

    public function render()    {
        $sucursales = Sucursal::latest('id')->paginate(5);
        return view('livewire.sucursal-component', compact('sucursales'));
    }

    public function store()    {
        $this->validate([
            'descripcion' => 'required|max:45',
            'direccion' => 'required|max:100'
        ]);
        Sucursal::create([
            'descripcion' => $this->descripcion,
            'direccion' => $this->direccion
        ]);
        $this->reset(['descripcion', 'direccion']);
    }

    public function edit(Sucursal $sucursal)    {
        $this->descripcion = $sucursal->descripcion;
        $this->direccion = $sucursal->direccion;
        $this->sucursal_id = $sucursal->id;
        $this->accion = "update";
    }

    public function update()    {
        $this->validate();
        $sucursal = Sucursal::find($this->sucursal_id);
        $sucursal->update([
            'descripcion' => $this->descripcion,
            'direccion' => $this->direccion
        ]);
        $this->reset(['descripcion', 'direccion', 'accion', 'sucursal_id']);
    }

    public function destroy(Sucursal $sucursal)    {
        $sucursal->delete();
        $this->reset(['descripcion', 'direccion']);
        $this->reset(['descripcion', 'direccion', 'accion', 'sucursal_id']);
    }
    
    public function default()    {
        $this->reset(['descripcion', 'direccion', 'accion', 'sucursal_id']);
    }

    /* public function confirmUserRemoval($userId){ */
    public function confirmUserRemoval(Sucursal $sucursal){
        $sucursal->delete();
        $this->reset(['descripcion', 'direccion']);
        $this->reset(['descripcion', 'direccion', 'accion', 'sucursal_id']);
        /* $this->userIdBeingRemoved = $userId; */
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser(){
        $user = Sucursal::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Usuario Eliminado!']);
    }
    /* public function incrementar(){
        $this->contar++;
    } */
}
