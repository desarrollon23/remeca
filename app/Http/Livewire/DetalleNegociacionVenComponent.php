<?php

namespace App\Http\Livewire;

use App\Models\ConsultaNegVenMontoPorCobrar;
use App\Models\NegociacionVenta;
use App\Models\ConsultaAbonoNegociacionVenta;
use App\Models\ConsultaAmortizacionNegociacionVenta;
use App\Models\CuentasPorCobrarVentas;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetalleNegociacionVenComponent extends Component
{
    public function render(){
    }

    public $sumamonto, $sumapagado, $sumaresta;
    public function show($cedula){
        $totalnegov = ConsultaNegVenMontoPorCobrar::where('cedula', $cedula)->get();
        //dd($totalnegov);
        $negociaciones = NegociacionVenta::where('cedulan', $cedula)
                                            ->where('finalizada','NO')->get();
        $creditos = CuentasPorCobrarVentas::where('cedula', $cedula)
                                            ->where('idnegociacionventa', '=', 0)
                                            ->where('finalizada','NO')->get();
        //dd($negociaciones->count());
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
        $productosabonados=ConsultaAbonoNegociacionVenta::all();
        $amortizacionesdepago=ConsultaAmortizacionNegociacionVenta::all();
        
        return view('livewire.ventas.detallenegociacion', 
                compact('totalnegov', 'negociaciones', 'creditos', 'productosrecepcion', 'productosabonados', 'amortizacionesdepago'));
    }

    /* public function crearabono(){
        return redirect('livewire.ventas.abono')
    } */
    
}
