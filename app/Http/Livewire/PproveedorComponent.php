<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proveedores;
use Livewire\WithPagination;

class PproveedorComponent extends Component
{
    use WithPagination;

    public $cedula, $nombre, $direccion, $telefono, $correo, $pproveedor_id, $visible;
    public $accion = "store";
    protected $rules = [
        'cedula' => 'required|max:12',
        'nombre' => 'required|max:100',
        'direccion' => 'required|max:250',
        'telefono' => 'required|max:30',
        'correo' => 'required|email|max:100',
    ];

    protected $validationattributs = [
        'cedula' => 'Cédula',
        'nombre' => 'Nombre',
        'direccion' => 'Dirección',
        'telefono' => 'Teléfono',
        'correo' => 'Correo',
    ];

    protected $messages = [
        'cedula.required' => 'Por favor ingrese la Cédula o Rif.',
        'cedula.max' => 'La Cédula o Rif no puede tener más de 15 caracteres.',
        'nombre.required' => 'Por favor ingrese el Nombre.',
        'nombre.max' => 'El Nombre no puede tener más de 100 caracteres.',
        'direccion.required' => 'Por favor ingrese la Dirección.',
        'direccion.max' => 'La Dirección no puede tener más de 250 caracteres.',
        'telefono.required' => 'Por favor ingrese el Teléfono.',
        'telefono.max' => 'El Teléfono no puede tener más de 30 caracteres.',
        'correo.required' => 'Por favor ingrese el correo.',
        'correo.max' => 'Ingrese un Correo con el siguiente formato nombre@dominio.com.'
    ];

    public function render()    {
        $pproveedores = Proveedores::all();
        return view('livewire.pproveedor-component', compact('pproveedores'));
    }

    public function store()    {
        $this->validate([
            'cedula' => 'required|max:15',
            'nombre' => 'required|max:100',
            'direccion' => 'required|max:250',
            'telefono' => 'required|max:30',
            'correo' => 'required|email|max:100',
        ]);
        Proveedores::create([
            'cedula' => $this->cedula,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'correo' => $this->correo
        ]);
        $this->reset(['cedula', 'nombre', 'direccion', 'telefono', 'correo', 'accion', 'pproveedor_id']);
    }

    public function edit(Proveedores $pproveedor)    {
        $this->cedula = $pproveedor->cedula;
        $this->nombre = $pproveedor->nombre;
        $this->direccion = $pproveedor->direccion;
        $this->telefono = $pproveedor->telefono;
        $this->correo = $pproveedor->correo;
        /* $this->visible = $pproveedor->visible; */
        $this->pproveedor_id = $pproveedor->id;
        $this->accion = "update";
    }

    public function update()    {
        $this->validate();
        $pproveedor = Proveedores::find($this->pproveedor_id);
        $pproveedor->update([
            'cedula' => $this->cedula,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'correo' => $this->correo
            /* 'visible' => $this->visible */
        ]);
        $this->reset(['cedula', 'nombre', 'direccion', 'telefono', 'correo', 'accion', 'pproveedor_id']);
    }

    public function destroy(Proveedores $pproveedor)    {
        $pproveedor->delete();
        $this->reset(['cedula', 'nombre','direccion', 'telefono', 'correo']);
        $this->reset(['cedula', 'nombre','direccion', 'telefono', 'correo', 'accion', 'pproveedor_id']);
    }
    
    public function default()    {
        $this->reset(['cedula', 'nombre', 'direccion', 'telefono', 'correo', 'accion', 'pproveedor_id']);
    }
}
