<?php

//use App\Http\Livewire\Almacen\Request;
use Illuminate\Http\Request;
use App\Models\AuditorSeguridad;
use App\Models\ClaveMaestra;
use App\Models\ConsultaRdVentas;
use App\Models\ConsultaRelcomnegRecepcionDiario;
use App\Models\ConsultaRelvennegDespachoDiario;
use App\Models\CuentasMaterial;
use App\Models\PrecioProducto;
use App\Models\Producto;

if (! function_exists('current_user')) {
    function current_user()
    {
        return auth()->user();
    }
}

if (! function_exists('auditar')) {
  function auditar($programa, $operacion)
  { //dd(auth()->user());
    AuditorSeguridad::create([
      'fechahora' => date('d-m-Y').' '.date("H:i:s"),
      'idusuario' => auth()->user()->id,
      'usuario' => auth()->user()->email,
      'nombre' => auth()->user()->name,
      'ip' => $_SERVER['REMOTE_ADDR'],
      'dispositivo' => $_SERVER['HTTP_USER_AGENT'],
      'programa' => $programa,
      'operacion' => $operacion
    ]);
  }
}

if (! function_exists('traeprecio')) {
  function traerprecio($cedulaproveedorprecios, $productoid){
    $tp = PrecioProducto::where('cedula', $cedulaproveedorprecios)
                         ->where('idproducto', $productoid)->count();
    if($tp!=0){ return PrecioProducto::where('cedula', $cedulaproveedorprecios)
                         ->where('idproducto', $productoid)->get()->pluck('precio')[0];
    }else{ return 0; }
  }
}

if (! function_exists('buscarclavemaestra')) {
  function buscarclavemaestra(){
    session(['clavemaestraactual'.auth()->user()->id => ClaveMaestra::where('idusuario', auth()->user()->id)->get()->pluck('clave')[0]]);
  }
}

if (! function_exists('traerdescripcionproducto')) {
  function traerdescripcionproducto($id){
    $dp = Producto::where('id', $id)->pluck('descripcion')[0];
    return $dp;
  }
}

/*    INICIO RELACION DE VENTAS DIARIAS       */
if (! function_exists('traecantidadventasrd')) {
  function traecantidadventasrd($cedula, $idproducto, $fecha){
    /* $cantidad=ConsultaRdVentas::where('cedula', $cedula)->where('idproducto', $idproducto)
                ->where('fecha', $fecha)->get()->pluck('cantidad'); */
    $cantidad=ConsultaRelvennegDespachoDiario::where('cedula', $cedula)->where('idproducto', $idproducto)
                ->where('fecha', $fecha)->get()->pluck('cantidad');
    if($cantidad->count()){ foreach($cantidad as $cant){ echo $cant."<br>"; } }
  }
}
if (! function_exists('traetotalcantidadventasrd')) {
  function traetotalcantidadventasrd($idproducto, $fecha){
    $cantidad=ConsultaRelvennegDespachoDiario::where('idproducto', $idproducto)
                ->where('fecha', $fecha)->get()->pluck('cantidad');
    echo $cantidad->sum();  }
}

if (! function_exists('traemcventasrd')) {
  function traemcventasrd($idproducto){
    $mc = Producto::where('id', $idproducto)->pluck('cantidad');
    if($mc->count()){return $mc[0];}else{return "0,00";}
  }
}

if (! function_exists('traemcpcventasrd')) {
  function traemcpcventasrd($idproducto){
    $mcpc = CuentasMaterial::where('idproducto', $idproducto)->pluck('cpc');
    if($mcpc->count()){return $mcpc[0];}else{return "0,00";}
  }
}

if (! function_exists('traemcppventasrd')) {
  function traemcppventasrd($idproducto){
    $mcpp = CuentasMaterial::where('idproducto', $idproducto)->pluck('cpp');
    if($mcpp->count()){return $mcpp[0];}else{return "0,00";}
  }
}
/*    FIN RELACION DE VENTAS DIARIAS          */

/*    INICIO RELACION DE COMPRAS DIARIAS      */
if (! function_exists('traecantidadcomprasrd')) {
  function traecantidadcomprasrd($cedula, $idproducto, $fecha){
    /* $cantidad=ConsultaRdVentas::where('cedula', $cedula)->where('idproducto', $idproducto)
                ->where('fecha', $fecha)->get()->pluck('cantidad'); */
    $cantidad=ConsultaRelcomnegRecepcionDiario::where('cedula', $cedula)->where('idproducto', $idproducto)
                ->where('fecha', $fecha)->get()->pluck('cantidad');
    if($cantidad->count()){ foreach($cantidad as $cant){ echo $cant."<br>"; } }
  }
}
if (! function_exists('traetotalcantidadcomprasrd')) {
  function traetotalcantidadcomprasrd($idproducto, $fecha){
    $cantidad=ConsultaRelcomnegRecepcionDiario::where('idproducto', $idproducto)
                ->where('fecha', $fecha)->get()->pluck('cantidad');
    echo $cantidad->sum();  }
}
/*    FIN RELACION DE COMPRAS DIARIAS         */