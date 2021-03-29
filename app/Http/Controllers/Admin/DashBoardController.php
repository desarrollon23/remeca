<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\almacen;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Venta;
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
    public function __invoke(Request $request)
    {
        //dd('Aquí');
        //return view('dashboard');
        /* $ccpp = DB::select('SELECT proveedores.nombre, _ccompras.diferenciapago FROM `_ccompras` INNER JOIN proveedores ON proveedores.cedula = _ccompras.cedula WHERE _ccompras.idestatuspago = 2');
 */
        $this->fecha = date('d-m-Y');
        /* $emd = Almacen::count()->where("fecha", $this->fecha) */
        //$emd = Almacen::count(); 'recibido' => 'NO'
        $emd = Almacen::where('fecha', date('d-m-Y'))
                        ->where('recibido', 'SI')->get();
        $dmd = Venta::where('despachado', 'NO')->get();
        $inventarios = Producto::all();
        $ccpp = Compra::join("proveedores","_ccompras.cedula","=","proveedores.cedula")
                        ->where('_ccompras.idestatuspago','=',2) // 2 = POR PAGAR
                        ->get();
        $ccpc = Venta::join("clientes","ventas.cedulav","=","clientes.cedulac")
                        ->where('ventas.idestatuspagov','=',2)  //2 = POR COBRAR
                        ->where('ventas.despachado','=','SI')  //2 = POR COBRAR
                        ->get();
        return view('admin.dashboard', compact(['emd', 'dmd' ,'inventarios', 'ccpp', 'ccpc']));
    }
}
