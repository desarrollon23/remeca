<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\almacen;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\ConsultaDetalleMaterialCpc;
use App\Models\ConsultaDetalleMaterialVpp;
use App\Models\ConsultaNegComMontoPorPagar;
use App\Models\ConsultaNegVenMontoPorCobrar;
use App\Models\ConsultaRdVentas;
use App\Models\ConsultaRelcomnegRecepcionDiario;
use App\Models\ConsultaRelvennegDespachoDiario;
use App\Models\CuentasMaterial;
use App\Models\NegociacionVenta;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Liquidez;
use App\Models\DespachoMaterial;
use App\Models\DetalleNegociacionVenta;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public $fecha;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /* protected $listeners = ['__invoke' => '__invoke']; */ //este es un oyente

    public function traecantidadventasrd($cedula, $idproducto){
        $cantidad=ConsultaRdVentas::where('cedula', $cedula)
                    ->where('idproducto', $idproducto)->pluck('cantidad');
        return $cantidad;
    }

    public function __invoke(Request $request){
        //dd('Aquí');
        //return view('dashboard');
        /* $ccpp = DB::select('SELECT proveedores.nombre, _ccompras.diferenciapago FROM `_ccompras` INNER JOIN proveedores ON proveedores.cedula = _ccompras.cedula WHERE _ccompras.idestatuspago = 2');
 */
        $this->fecha = date('d-m-Y');
        /* $emd = Almacen::count()->where("fecha", $this->fecha) */
        //$emd = Almacen::count(); 'recibido' => 'NO'
        $emd = Almacen::where('fecha', date('d-m-Y'))
                        ->where('recibido', 'SI')->get();

        /* $despachos = DespachoMaterial::all()->where('idestatusd', 1);
        $dmd = Venta::where('despachado', 'NO')->get(); */
        $dmd = DespachoMaterial::all()->where('idestatusd', 1);

        $inventarios = Producto::all();
        /* $materialcpp = DetalleNegociacionVenta::all(); */
        $materialcppcpc = CuentasMaterial::all();
        
        /* $ccpp = Compra::join("proveedores","_ccompras.cedula","=","proveedores.cedula")
                        ->where('_ccompras.idestatuspago','=',2) // 2 = POR PAGAR
                        ->get(); */
        $ccpp = ConsultaNegComMontoPorPagar::all(); //la estructura de esta consula está en la BBDD
        $ccpc = ConsultaNegVenMontoPorCobrar::all(); //la estructura de esta consula está en la BBDD

        //dd($ccpc);
        $efectivo = Liquidez::where('id', 1)->get()->pluck('efectivo');
        $banco = Liquidez::where('id', 1)->get()->pluck('banco');
        /* dd($efectivo[0]); */
        /* $efectivo; */

        /* RELACION DIARIA */
        $productosrd = Producto::all();
        $clientesrd = Cliente::all();
        $proveedoresrd = Proveedores::all();
        //dd($proveedoresrd);
        
        /* $ventasrdclientes = ConsultaRdVentas::all(); */
        $ventasrdclientes = ConsultaRelvennegDespachoDiario::all();
        $comprasproveedores = ConsultaRelcomnegRecepcionDiario::all();
        return view('admin.dashboard', compact(['emd', 'dmd' ,'inventarios', 'materialcppcpc', 'ccpp', 'ccpc', 'efectivo', 'banco', 'productosrd', 'clientesrd', 'ventasrdclientes', 'proveedoresrd', 'comprasproveedores']));
    }
}
