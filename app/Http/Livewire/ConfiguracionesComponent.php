<?php

namespace App\Http\Livewire;

use App\Models\ClaveMaestra;
use App\Models\PrecioProducto;
use App\Models\Producto;
use App\Models\Proveedores;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ConfiguracionesComponent extends Component
{

    /* INICIO CAMBIAR CLAVE MAESTRA */
    public $cambiarclave="NO", $claveactual, $nuevaclave;

    public function deseacambiar(){
        auditar('CONFIGURACIONES GENERALES - CAMBIAR CLAVE MAESTRA', 'CAMBIAR');
        $this->cambiarclave="SI";
    }
    
    public function cambiar(){ /* A ESTA VARIABLE SE LE ASIGNA EL VALOR EN EL HELPERS
        session('clavemaestraactual'.auth()->user()->id) */
        buscarclavemaestra();
        if((is_null($this->claveactual)!="true" and strlen($this->claveactual)>=4 and strlen($this->claveactual)<=8) and
        (is_null($this->nuevaclave)!="true" and strlen($this->nuevaclave)>=4 and strlen($this->nuevaclave)<=8)){
            if(session('clavemaestraactual'.auth()->user()->id)==$this->claveactual){
                $idusr=ClaveMaestra::where('idusuario',auth()->user()->id)->get()->pluck('id')[0];
                $cmbclv=ClaveMaestra::find($idusr);
                $cmbclv->update(['clave' => $this->nuevaclave]);
                buscarclavemaestra();
                auditar('CONFIGURACIONES GENERALES - CAMBIAR CLAVE MAESTRA', 'CAMBIADA');
                $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'SE HA CAMBIADO LA CLAVE']);
                /* $this->dispatchBrowserEvent('confirmarcambiodeclavemaestra', ['confirmacambioclavemaestra' => 'SI']); */
                $this->cambiarclave="NO";
            }else{
                $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'LA CLAVE ACTUAL INGRESADA ESTA ERRADA']);
            }
        }else{
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'LA CLAVE DEBE TENER ENTRE 4 Y 8 CARACTERES']);
        }
    }

    public function cancelar(){
        auditar('CONFIGURACIONES GENERALES - CAMBIAR CLAVE MAESTRA', 'CANCELAR');
        $this->reset(['cambiarclave', 'claveactual', 'nuevaclave']);
    }
    /* FIN CAMBIAR CLAVE MAESTRA */

    /* INICIO PRECIOS PROVEEDOR */
    public $cedulaproveedorprecios, $productoid;
    public $p, $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10,
    $p11, $p12, $p13, $p14, $p15, $p16, $p17, $p18, $p19, $p20,
    $p21, $p22, $p23, $p24, $p25, $p26, $p27, $p28, $p29, $p30,
    $p31, $p32, $p33, $p34, $p35, $p36, $p37, $p38, $p39, $p40,
    $p41, $p42, $p43, $p44, $p45, $p46, $p47, $p48, $p49, $p50;

    public function traeprecio($cedulaproveedorprecios, $productoid){
        $tp = PrecioProducto::where('cedula', $cedulaproveedorprecios)
                             ->where('idproducto', $productoid)->count();
        if($tp!=0){ return PrecioProducto::where('cedula', $cedulaproveedorprecios)
                             ->where('idproducto', $productoid)->get()->pluck('precio')[0];
        }else{ return 0; }
    }

    public function cambiarprecios(){
        for ($i=2; $i <= Producto::count(); $i++) {
            $cp = PrecioProducto::where('cedula', $this->cedulaproveedorprecios)->where('idproducto', $i)->count();
            if($cp!=0){
                 $idp = PrecioProducto::where('cedula', $this->cedulaproveedorprecios)->where('idproducto', $i)->get()->pluck('id')[0];
                $np = PrecioProducto::find($idp);
                $np->update(['precio' => $this->{"p".$i}]);
            }else{
                PrecioProducto::create([
                    'cedula' => $this->cedulaproveedorprecios,
                    'idproducto' => $i,
                    'precio' => (double)$this->{"p".$i} ]);
            }
        }
        auditar('CONFIGURACIONES GENERALES - CAMBIAR PRECIOS', 'SE CAMBIARON');
        $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'SE HAN CAMBIADO LOS PRECIOS']);
        $this->reset(['p', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16', 'p17', 'p18', 'p19', 'p20', 'p21', 'p22', 'p23', 'p24', 'p25', 'p26', 'p27', 'p28', 'p29', 'p30', 'p31', 'p32', 'p33', 'p34', 'p35', 'p36', 'p37', 'p38', 'p39', 'p40', 'p41', 'p42', 'p43', 'p44', 'p45', 'p46', 'p47', 'p48', 'p49', 'p50']);        
    }

    public function cancelarcambiarprecios(){
        auditar('CONFIGURACIONES GENERALES - CAMBIAR PRECIOS', 'CANCELAR');
        $this->reset(['cedulaproveedorprecios', 'productoid', 'p', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16', 'p17', 'p18', 'p19', 'p20', 'p21', 'p22', 'p23', 'p24', 'p25', 'p26', 'p27', 'p28', 'p29', 'p30', 'p31', 'p32', 'p33', 'p34', 'p35', 'p36', 'p37', 'p38', 'p39', 'p40', 'p41', 'p42', 'p43', 'p44', 'p45', 'p46', 'p47', 'p48', 'p49', 'p50']);
    }
    /* FIN PRECIOS PROVEEDOR */

    public function render()
    {
        /* dd(PrecioProducto::where('cedula', 'v77777777')
        ->where('idproducto', 2)->get()->pluck('precio')[0]); */

        /* $this->clavemaestra = ClaveMaestra::where('idusuario', auth()->user()->id)->get()->pluck('clave');
        session(['clavemaestraactual' => $this->clavemaestra]);
        $this->clavemaestra=""; */
        $proveedores = Proveedores::all();
        $productos = Producto::all();
        return view('livewire.configuraciones-component'
            , compact('proveedores', 'productos'));
    }
}
