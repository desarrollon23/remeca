<?php

//use App\Http\Livewire\Almacen\Request;
use Illuminate\Http\Request;
use App\Models\AuditorSeguridad;


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