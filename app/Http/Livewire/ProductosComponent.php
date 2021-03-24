<?php

namespace App\Http\Livewire;

use App\Models\Inventario;
use Livewire\Component;
use App\Models\Producto;

class ProductosComponent extends Component
{
    public $descripcion, $precio, $cantidad, $producto_id;
    public $accion = "store";
    protected $rules = [
        'descripcion' => 'required',
        'precio' => 'required',
        'cantidad' => 'required'
    ];

    protected $validationattributs = [
        'descripcion' => 'Descripción',
        'precio' => 'Precio',
        'cantidad' => 'Cantidad'
    ];

    protected $messages = [
        'descripcion.required' => 'Por favor ingrese la Descripción.',
        'descripcion.max' => 'La Descripción no puede tener más de 45 caracteres.',
        'precio.required' => 'Por favor ingrese el Precio.',
        'precio.max' => 'La Precio no puede tener más de 8 cífras.',
        'cantidad.required' => 'Por favor ingrese la Cantidad.',
        'cantidad.max' => 'El Precio no puede tener más de 8 cífras.'
    ];

    public function render()    {
        $productos = Producto::all();
        return view('livewire.productos-component', compact('productos'));
    }

    public function store()    {
        $this->validate([
            'descripcion' => 'required|max:45',
            'precio' => 'required|max:8',
            'cantidad' => 'required|max:8'
        ]);
        Producto::create([
            'idcate' => 1,       // SE DEBE CREAR UN LISTBOX CON LAS CATEGORÍAS
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'cantidad' =>  $this->cantidad
            
        ]);
        //guardar el producto en el inventario
        //buscar la existena del producto en la tabla producto
        $fechacomprau = date('d-m-Y');
        $existenciapro=Producto::latest('id')->first();
        $datosInventario = Inventario::create([
            'fecha' => $fechacomprau,
            'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
            'idproducto' => $existenciapro->id,
            'comprados' => 0,
            'vendidos' => 0,
            'existencia' => $this->cantidad
        ]);
        $this->reset(['descripcion', 'precio', 'cantidad']);
    }

    public function edit(Producto $producto)    {
        $this->descripcion = $producto->descripcion;
        $this->precio = $producto->precio;
        $this->cantidad = $producto->cantidad;
        $this->producto_id = $producto->id;
        $this->accion = "update";
    }

    public function update()    {
        $this->validate();
        $producto = Producto::find($this->producto_id);
        $producto->update([
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad
        ]);
        //guardar el producto en el inventario
        //buscar la existena del producto en la tabla producto
        $fechacomprau = date('d-m-Y');
        $existenciapro=Producto::find($this->producto_id);
        $datosInventario = Inventario::create([
            'fecha' => $fechacomprau,
            'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
            'idproducto' => $existenciapro->id,
            'comprados' => 0,
            'vendidos' => 0,
            'existencia' => $this->cantidad
        ]);
        $this->reset(['descripcion', 'precio', 'cantidad', 'accion', 'producto_id']);
    }

    public function destroy(Producto $producto)    {
        $producto->delete();
        $this->reset(['descripcion', 'precio']);
        $this->reset(['descripcion', 'precio', 'cantidad', 'accion', 'producto_id']);
    }
    
    public function default()    {
        $this->reset(['descripcion', 'precio', 'cantidad', 'accion', 'producto_id']);
    }
}
