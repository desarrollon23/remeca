<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
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
        $inventarios = Producto::all();
        $ccpp = Compra::join("proveedores","_ccompras.cedula","=","proveedores.cedula")
                        ->where('_ccompras.idestatuspago','=',2)
                        ->get();
        return view('admin.dashboard', compact(['ccpp', 'inventarios']));
    }
}
