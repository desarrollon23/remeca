<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proveedores;
use App\Models\Producto;
use App\Models\PreciosProveedores;

class PrecioProducto extends Component
{
    public $open = "false";
    public $proveedor, $proveedores, $precios, $productos;

    public function mount(Proveedores $proveedor, $cedula){
        $this->proveedor = $proveedor;
        $this->precios = PreciosProveedores::where('cedula', $cedula)->get();
    }

    public function render()
    {
        return view('livewire.precio-producto');
    }
}
