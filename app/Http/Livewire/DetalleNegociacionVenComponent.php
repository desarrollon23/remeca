<?php

namespace App\Http\Livewire;

use App\Models\ConsultaNegVenMontoPorCobrar;
use App\Models\NegociacionVenta;
use App\Models\ConsultaAbonoNegociacionVenta;
use App\Models\ConsultaAmortizacionNegociacionVenta;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetalleNegociacionVenComponent extends Component
{
    public function render(){
    }

    public function show($cedula){
        $totalnegov = ConsultaNegVenMontoPorCobrar::where('cedula', $cedula)->get();
        $negociaciones = NegociacionVenta::where('cedulan', $cedula)
                                            ->where('finalizada','NO')->get();
        $recepcionmaterial_id = $negociaciones[0]->id;
        $productosrecepcion=DB::table('detalle_negociacion_ventas')
            ->join('_pproductos', 'detalle_negociacion_ventas.producto_idn', '=', '_pproductos.id')
            ->get();
        $productosabonados=ConsultaAbonoNegociacionVenta::all();
        $amortizacionesdepago=ConsultaAmortizacionNegociacionVenta::all();

        return view('livewire.ventas.detallenegociacion', 
                compact('totalnegov', 'negociaciones', 'productosrecepcion', 'productosabonados', 'amortizacionesdepago'));
    }

    /* public function crearabono(){
        return redirect('livewire.ventas.abono')
    } */
    
}
