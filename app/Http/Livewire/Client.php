<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class Client extends Component
{
    use WithPagination;

    public $cedulac, $nombrec, $direccionc, $telefonoc, $correoc, $cliente_id, $visible;
    public $accion = "store";
    protected $rules = [
        'cedulac' => 'required|max:12',
        'nombrec' => 'required|max:100',
        'direccionc' => 'required|max:250',
        'telefonoc' => 'required|max:30',
        'correoc' => 'required|email|max:100',
    ];

    protected $validationattributs = [
        'cedulac' => 'Cédula',
        'nombrec' => 'Nombre',
        'direccionc' => 'Dirección',
        'telefonoc' => 'Teléfono',
        'correoc' => 'Correo',
    ];

    protected $messages = [
        'cedulac.required' => 'Por favor ingrese la Cédula o Rif.',
        'cedulac.max' => 'La Cédula o Rif no puede tener más de 15 caracteres.',
        /* 'cedulac.unique' => 'La Cédula o Rif ya exixte.', */
        'nombrec.required' => 'Por favor ingrese el Nombre.',
        'nombrec.max' => 'El Nombre no puede tener más de 100 caracteres.',
        'direccionc.required' => 'Por favor ingrese la Dirección.',
        'direccionc.max' => 'La Dirección no puede tener más de 250 caracteres.',
        'telefonoc.required' => 'Por favor ingrese el Teléfono.',
        'telefonoc.max' => 'El Teléfono no puede tener más de 30 caracteres.',
        'correoc.required' => 'Por favor ingrese el correoc.',
        'correoc.max' => 'Ingrese un Correo con el siguiente formato nombrec@dominio.com.'
    ];

    public function render(){
        $clientes = Cliente::all();
        return view('livewire.client', compact('clientes'));
    }

    public function store()    {
        $this->validate([
            'cedulac' => 'required|max:15',
            'nombrec' => 'required|max:100',
            'direccionc' => 'required|max:250',
            'telefonoc' => 'required|max:30',
            'correoc' => 'required|email|max:100'
        ]);
        Cliente::create([
            'cedulac' => $this->cedulac,
            'nombrec' => $this->nombrec,
            'direccionc' => $this->direccionc,
            'telefonoc' => $this->telefonoc,
            'correoc' => $this->correoc
        ]);
        auditar('CLIENTE - DATOS: '.
            ' Cedula: '.$this->cedulac.
            ' Nombre: '.$this->nombrec.
            ' Direccion: '.$this->direccionc.
            ' Telefono: '.$this->telefonoc.
            ' Correo: '.$this->correoc, 'CREAR');
        $this->reset(['cedulac', 'nombrec', 'direccionc', 'telefonoc', 'correoc', 'accion', 'cliente_id']);
    }

    public function edit(Cliente $cliente)    {
        $this->cedulac = $cliente->cedulac;
        $this->nombrec = $cliente->nombrec;
        $this->direccionc = $cliente->direccionc;
        $this->telefonoc = $cliente->telefonoc;
        $this->correoc = $cliente->correoc;
        $this->visible = 'SI';
        $this->cliente_id = $cliente->id;
        $this->accion = "update";
        auditar('CLIENTE #: '.$cliente->id.' DATOS ACTUALES: '.
            ' Cedula: '.$cliente->cedulac.
            ' Nombre: '.$cliente->nombrec.
            ' Direccion: '.$cliente->direccionc.
            ' Telefono: '.$cliente->telefonoc.
            ' correo: '.$cliente->correoc, 'EDITAR');
    }

    public function update()    {
        $this->validate();
        $cliente = Cliente::find($this->cliente_id);
        $cliente->update([
            'cedulac' => $this->cedulac,
            'nombrec' => $this->nombrec,
            'direccionc' => $this->direccionc,
            'telefonoc' => $this->telefonoc,
            'correoc' => $this->correoc,
            $this->visible = 'SI'
        ]);
        auditar('CLIENTE #: '.$cliente->id.' NUEVOS DATOS: '.
            ' Cedula: '.$this->cedulac.
            ' Nombre: '.$this->nombrec.
            ' Direccion: '.$this->direccionc.
            ' Telefono: '.$this->telefonoc.
            ' Correo: '.$this->correoc, 'GUARDAR');

        $this->reset(['cedulac', 'nombrec', 'direccionc', 'telefonoc', 'correoc', 'accion', 'cliente_id']);
    }

    public function destroy(Cliente $cliente)    {
        $cliente->delete();
        auditar('CLIENTE #: '.$cliente->id, 'ELIMINAR');
        $this->reset(['cedulac', 'nombrec','direccionc', 'telefonoc', 'correoc']);
        $this->reset(['cedulac', 'nombrec','direccionc', 'telefonoc', 'correoc', 'accion', 'cliente_id']);
    }
    
    public function default()    {
        auditar('CLIENTE', 'CANCELAR');
        $this->reset(['cedulac', 'nombrec', 'direccionc', 'telefonoc', 'correoc', 'accion', 'cliente_id']);
    }
}
