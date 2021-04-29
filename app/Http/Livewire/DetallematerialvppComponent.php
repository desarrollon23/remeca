<?php

namespace App\Http\Livewire;

use App\Models\ConsultaDetalleMaterialVpp;
use Livewire\Component;

class DetallematerialvppComponent extends Component
{
    public function render()
    {
        //return view('livewire.detallematerialvpp-component');
    }
    
    public function show($id){
        $cdmvpp = ConsultaDetalleMaterialVpp::where('idproducto', $id)->get();
        return view('livewire.ventas.detallematerialvpp-component', compact('cdmvpp'));
    }
}
