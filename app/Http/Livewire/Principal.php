<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Models\almacen;
use App\Models\Compra;
use App\Models\ConsultaNegVenMontoPorCobrar;
use App\Models\CuentasMaterial;
use App\Models\NegociacionVenta;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Liquidez;
use App\Models\DespachoMaterial;
use App\Models\DetalleNegociacionVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Principal extends Component
{
    public $fecha;

    protected $listeners = ['render'];
    
    public function render()
    {
        $this->fecha = date('d-m-Y');
        $emd = Almacen::where('fecha', date('d-m-Y'))
                        ->where('recibido', 'SI')->get();
        $dmd = DespachoMaterial::all()->where('idestatusd', 1);
        $inventarios = Producto::all();
        $materialcpp = CuentasMaterial::all();
        $ccpp = Compra::join("proveedores","_ccompras.cedula","=","proveedores.cedula")
                        ->where('_ccompras.idestatuspago','=',2) // 2 = POR PAGAR
                        ->get();
        $ccpc = ConsultaNegVenMontoPorCobrar::all(); //la estructura de esta consula está en la BBDD
        $efectivo = Liquidez::where('id', 1)->get()->pluck('efectivo');
        $banco = Liquidez::where('id', 1)->get()->pluck('banco');
        /* return view('admin.dashboard', compact(['emd', 'dmd' ,'inventarios', 'materialcpp', 'ccpp', 'ccpc', 'efectivo', 'banco'])); */
        return view('livewire.principal', compact(['emd', 'dmd' ,'inventarios', 'materialcpp', 'ccpp', 'ccpc', 'efectivo', 'banco']));
    }
}
