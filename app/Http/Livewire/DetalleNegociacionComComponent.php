<?php

namespace App\Http\Livewire;

use App\Models\ConsultaAbonoNegociacionCompra;
use App\Models\ConsultaAmortizacionNegociacionCompra;
use App\Models\ConsultaNegComMontoPorPagar;
use App\Models\NegociacionCompra;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetalleNegociacionComComponent extends Component
{
    public function render($cedula){
    }

    public function show($cedula){
        $totalnegov = ConsultaNegComMontoPorPagar::where('cedula', $cedula)->get();
        $negociaciones = NegociacionCompra::where('cedulan', $cedula)
                                            ->where('finalizada','NO')->get();
        if($negociaciones->count()!=0){
            $recepcionmaterial_id = $negociaciones[0]->id;
        }/* else{
            $negociaciones = CuentasPorCobrarVentas::where('cedulan', $cedula)
                                            ->where('finalizada','NO')->get();
            $recepcionmaterial_id = $negociaciones[0]->id;
        } */
        $productosrecepcion=DB::table('detalle_negociacion_ventas')
            ->join('_pproductos', 'detalle_negociacion_ventas.producto_idn', '=', '_pproductos.id')
            ->get();
        $productosabonados=ConsultaAbonoNegociacionCompra::all();
        $amortizacionesdepago=ConsultaAmortizacionNegociacionCompra::all();
        
        return view('livewire.compras.detallenegociacion', 
                compact('totalnegov', 'negociaciones', 'productosrecepcion', 'productosabonados', 'amortizacionesdepago'));
        /* return view('livewire.detalle-negociacion-com-component'); */
    }
}
