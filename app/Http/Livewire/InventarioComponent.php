<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\ConsultaInventario;
use Illuminate\Support\Facades\DB;

class InventarioComponent extends Component
{
    public function render($id)
    {
        //return view('livewire.inventario');
    }

    public function show($id){
        $inventario = ConsultaInventario::where('idproducto', $id)->get();
        /* $inventario=DB::table('_iinventario')
            ->join('_pproductos', '_iinventario.idproducto', '=', '_pproductos.id')
            ->where('_pproductos.id',$id)
            ->orderby('_iinventario.id', 'desc')->get(); */
        //dd($inventario);
        return view('livewire.almacen.inventario', compact('inventario'));
    }
}
