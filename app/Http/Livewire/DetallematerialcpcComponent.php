<?php

namespace App\Http\Livewire;

use App\Models\ConsultaDetalleMaterialCpc;
use Livewire\Component;

class DetallematerialcpcComponent extends Component
{
    public function render()
    {
        //return view('livewire.detallematerialcpc-component');
    }

    public function show($id){
        $cdmcpc = ConsultaDetalleMaterialCpc::where('idproducto', $id)->get();
        return view('livewire.compras.detallematerialcpc-component', compact('cdmcpc'));
    }
}
