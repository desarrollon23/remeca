<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\Material;
use App\Models\almacen;
use App\Models\Detallealmacen;
use App\Models\Compra;
use App\Models\DetalleComprador;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;
use App\Models\DespachoMaterial;
use App\Models\AbonoMaterialNegociacionVentas;
use App\Models\ConsultaDespachoAbonoMaterialVentas;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
//use App\Http\Livewire\Almacen\Request;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Cache;
use App\Http\Livewire\Input;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Http\Livewire\Compras;
use App\Models\Cliente;
use App\Models\ConsultaDespachoAbono;
use App\Models\ConsultaDespachoVentas;
use App\Models\DetalleDespacho;
use App\Models\DetalleVenta;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class DespachoComponent extends Component
{
    public $cedulav, $nombrev, $observacionesv;
    public $fecha, $fechacompra, $hora, $cedula, $nombre, $idlugar, $pesofull, $pesovacio, $pesoneto, $observaciones, $almacen_id, $idestatuspago, $idtipopago, $totalcomra, $totalpagado, $diferenciapago, $fecharecepcion, $datos;

    public $recepcion, $recepcionmaterial_id, $producto_id, $cantidadprorecmat, $operacion, $detalmacen_id, $observacionesc;
    public $idproducto;
    public $accion = "store", $acciones = "stores";
    public $productosr;
    public $pesocalculado = 0, $acumulado = 0, $acumuladoc = 0;
    public $numcierre;
    public $accionrecmat;
    public $nopuedeguardar;
    public $pesodisponible = 0, $pesodisponiblec = 0;
    public $close, $vclose;
    public $toprodacum, $diferenciadepago;
    public $compra_id, $compra;
    public $datalcl, $fechacomprau;
    public $i, $precio = [], $preciopro, $totalpro, $toprod = [];
    public $idestatuspagoc, $idtipopagoc;
    public $datosInventario, $datosc, $datosdc, $nexistencia;
    public $verificaoperacion;
    public $cantidadp1, $cantidadp2, $cantidadp3, $cantidadp4, $cantidadp5, $cantidadp6, $cantidadp7, $cantidadp8, $cantidadp9, $cantidadp10;
    public $precio1, $precio2, $precio3, $precio4, $precio5, $precio6, $precio7, $precio8, $precio9, $precio10;
    public $toprod1, $toprod2, $toprod3, $toprod4, $toprod5, $toprod6, $toprod7, $toprod8, $toprod9, $toprod10;
    public $cantpro, $totalcalculado, $sobregiro, $vpeso;
    public $probc, $muesdesmaterial, $mostrar = "false", $mostrarm = "false", $iddespacho;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $estate = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    public function busnumal(){ //BUSCA LOS DATOS DEL ALMACEN
        $nc = Venta::count();
        if($nc>0){ 
            if($this->recepcionmaterial_id>$nc){ 
                $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'El número de Factura '.$this->recepcionmaterial_id.' no se ha creado']);
                $this->datalm=""; $this->limpiar();
            }elseif(($this->recepcionmaterial_id>0) and ($this->recepcionmaterial_id<=$nc)){
                $datalm = Venta::find($this->recepcionmaterial_id);
                if($datalm->despachado=="NO"){
                    $datalm = Venta::find($this->recepcionmaterial_id);
                    $this->fecha = isset($datalm->fecha) ? $datalm->fecha : "";
                    $this->cedulav = isset($datalm->cedulav) ? $datalm->cedulav : "";
                    $datalmn=Cliente::where('cedulac',$datalm->cedulav)->get()->pluck('nombrec');
                    $this->nombre = isset($datalmn) ? $datalmn : "";
                    /* $datalml=Sucursal::where('id',$datalm->idlugar)->get()->pluck('descripcion');
                    $this->idlugar = isset($datalml) ? $datalml : "";
                    $this->pesofull = isset($datalm->pesofull) ? $datalm->pesofull : "";
                    $this->pesovacio = isset($datalm->pesovacio) ? $datalm->pesovacio : "";
                    $this->pesoneto = isset($datalm->pesoneto) ? $datalm->pesoneto : "";
                    $this->pesocalculado = isset($datalm->pesocalculado) ? $datalm->pesocalculado : ""; */
                    $this->observacionesv = isset($datalm->observacionesv) ? $datalm->observacionesv : "";
                }else{
                    $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'El número de Factura '.$this->recepcionmaterial_id.' ya fue procesado']);
                    $this->datalm=""; $this->limpiar();
                }
            }else{ $this->limpiar(); }
        }
    }

    public function update($venta){
        $datosc = DespachoMaterial::find($venta);
        $datosc->update(['idestatusd' => 2]);
        $v=Venta::where('iddespacho', $venta);
        if($v->count()){ $v->update(['despachado' => 'SI']); }
        $a=AbonoMaterialNegociacionVentas::where('iddespacho', $venta);
        if($a->count()){ $a->update(['despachado' => 'SI']); }
        $this->mostrar = "false"; $this->mostrarm = "false";
        auditar('ENTREGA DE MATERIAL #: '.$venta, 'ENTREGAR');
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Material Despachado!']);
        $this->reset(['cedulav', 'nombre', /* 'observacionesv', */ 'recepcionmaterial_id', 'iddespacho']);
    }
    
    public function traeprematerial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['precio'];
        return $this->muesdesmaterial;
    }

    public function limpiar(){
        $this->reset(['compra', 'cedulav', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'state', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', ]);
    }

    public function traedesmaterial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['descripcion'];
        return $this->muesdesmaterial;
    }

    public function render(){
        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $recepcion = Almacen::all()->where('recibido', 'NO');
        $materiales = Material::all();
        $este=$this->recepcion;
        $productosrecepcion=Detallealmacen::all()->where('recepcionmaterial_id', 
        $this->recepcionmaterial_id);

        $despachos = DespachoMaterial::all()->where('idestatusd', 1);
        if(is_null($this->iddespacho)!="null"){
            if($this->iddespacho>0){
                $this->cedulav=$despachos->where('id', $this->iddespacho)->pluck('cedula')[0];
                $probn=Cliente::where('cedulac', $despachos->where('id', $this->iddespacho)->pluck('cedula')    [0])->pluck('nombrec')[0];
                $this->nombre=$probn;
            }
        }
        $productosdespachos = DetalleDespacho::all()->where('iddespacho', $this->iddespacho);
       
        return view('livewire.despacho-component', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion', 'despachos', 'productosdespachos', /* 'clientes' */));
    }
}
