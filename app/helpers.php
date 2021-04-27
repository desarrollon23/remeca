<?php

//use App\Http\Livewire\Almacen\Request;
use Illuminate\Http\Request;
use App\Models\AuditorSeguridad;
use App\Models\ClaveMaestra;
use App\Models\ConsultaRdVentas;
use App\Models\CuentasMaterial;
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

if (! function_exists('buscarclavemaestra')) {
  function buscarclavemaestra(){
    session(['clavemaestraactual'.auth()->user()->id => ClaveMaestra::where('idusuario', auth()->user()->id)->get()->pluck('clave')[0]]);
  }
}

if (! function_exists('traecantidadventasrd')) {
  function traecantidadventasrd($cedula, $idproducto){
    $cantidad=ConsultaRdVentas::where('cedula', $cedula)
                ->where('idproducto', $idproducto)->get()->pluck('cantidad');
    if($cantidad->count()){return $cantidad[0];}
  }
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
