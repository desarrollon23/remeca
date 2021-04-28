<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index(){
        return view('contacto.index');
    }

    /* EL FORMULARIO NO SE HA CREADO */
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required',
        ]);

        $correo = new ContactoMailable($request->all()); 
        Mail::to('julion23@gmail.com')->send($correo);
        return redirect()->route('contacto.index')->with('info', 'Mensaje enviado');

        /* lo de abajo va en la vista */
        /* @if(session('info'))
            <script>
                alert("{{session('info')}}")
            </script>
        @endif */
    }
}
