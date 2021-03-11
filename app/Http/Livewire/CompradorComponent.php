<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Compra;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;

class CompradorComponent extends Component
{
    public $cedula, $compra_id;
    //public $clientes;
    public $accion = "store";
    protected $rules = [
        'cedula' => 'required'
    ];

    protected $validationattributs = [
        'cedula' => 'Cédula'
    ];

    protected $messages = [
        'cedula.required' => 'Por favor ingrese la Cédula o Rif.',
        'cedula.max' => 'La Cédula no puede tener más de 15 caracteres.',
        'cedula.min' => 'La Cédula no puede tener menos de 10 caracteres.',
    ];

    public function render()    {
        $compradores = Compra::all();
        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        return view('livewire.comprador-component', compact('compradores', 'vendedores', 'lugares', 'productos'));
    }

    public function store()    {
        $this->validate([
            'cedula' => 'required|min:10|max:15',
        ]);
        Compra::create([
            'cedula' => $this->cedula,
            'idlugar' => $this->idlugar,
        ]);
        $this->reset(['cedula']);
    }

    public function edit(Compra $Compra)    {
        $this->cedula = $Compra->cedula;
        $this->idlugar = $Compra->idlugar;
        $this->compra_id = $Compra->id;
        $this->accion = "update";
    }

    public function update()    {
        $this->validate();
        $Compra = Compra::find($this->compra_id);
        $Compra->update([
            'cedula' => $this->cedula,
            'idlugar' => $this->idlugar
        ]);
        $this->reset(['cedula', 'idlugar', 'accion', 'compra_id']);
    }

    public function destroy(Compra $Compra)    {
        $Compra->delete();
        $this->reset(['cedula', 'idlugar']);
        $this->reset(['cedula', 'idlugar', 'accion', 'compra_id']);
    }
    
    public function default()    {
        $this->reset(['cedula', 'idlugar', 'accion', 'compra_id']);
    }
}
