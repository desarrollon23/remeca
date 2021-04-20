<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Material;
use App\Models\DetalleNegociacionCompra;
use App\Models\NegociacionCompra;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;
use App\Models\CuentasMaterial;
use App\Models\Liquidez;
use App\Models\PreciosProveedores;

class NegociacioncComponent extends Component
{
    /* public function __construct() //PROTEGE LAS RUTAS PARA QUE NO LA ABRA UN USUARIO SI NO TIENE PERMISO
    {
        $this->middleware('can:livewire.almacen.material-reception.index')->only('index');
        $this->middleware('can:livewire.almacen.material-reception.create')->only('create', 'store');
        $this->middleware('can:livewire.almacen.material-reception.edit')->only('edit', 'update');
        $this->middleware('can:livewire.almacen.material-reception.destroy')->only('destroy');
    } */
    
    public $mostraremid='false', $mostraremc='false', $mostraremp='false', $pesotn=0, $montotn;
    public $negociacion_id, $producto_idn, $cantidadprorecmatn, $precionegn, $totalpronegn;
    public $fechan, $cedulan, $nombren, $idlugarn, $idtipopagon, $idtipoabonon, $required, $observaciones, $preciopron, $totalcalculado;
    public $fecha, $cedula, $idlugar, $pesofull, $pesovacio, $pesoneto, $almacen_id;
    public $recepcion, $recepcionmaterial_id, $producto_id, $cantidadprorecmat, $operacion, $detalmacen_id;
    public $accion = "store";
    public $acciones = "stores";
    public $productosr;
    public $pesocalculado = 0;
    public $acumulado = 0;
    public $acumuladoc = 0;
    public $numcierre;
    public $accionrecmat;
    public $nopuedeguardar;
    public $pesodisponible = 0;
    public $pesodisponiblec = 0;
    public $pesodisponi;
    public $close, $muesdesmaterial;
    public $vclose, $vpeso = "false", $pesoi;
    public $ptg, $ptf, $pmm;
    public $editm_id, $traesuma='NO', $mostrar='false', $mostrarm='false';
    public $idtipopagoneg, $pagoefectivoneg, $pagotransfneg, $totalpagoneg, $restapagoneg, $validamontotn, $mostrarpagoneg='false', $mostrard = "false";

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    protected $rules = [
        //'fechan' => 'required',
        'cedulan' => 'required|max:15',
        'nombren' => 'required|max:50',
        /* 'idlugarn' => 'required',
        'idtipopagon' => 'required',
        'idtipoabonon' => 'required', */
        'observaciones' => 'required|max:250',
        /* 'producto_idn' => 'required',
        'cantidadprorecmatn' => 'required|max:8',
        'precionegn' => 'required|max:8', */
    ];

    protected $validationattributs = [
        //'fechan' => 'Fecha',
        'cedulan' => 'Cédula',
        'nombren' => 'Nombre',
        /* 'idlugarn' => 'Lugar',
        'idtipopagon' => 'Tipo de Pago',
        'idtipoabonon' => 'Tipo de Abono', */
        'observaciones' => 'Observaciones',
        /* 'producto_idn' => 'Material',
        'cantidadprorecmatn' => 'Cantidad',
        'precionegn' => 'Precio', */
    ];

    protected $messages = [
        'cedulan.required' => 'Ingrese la Cédula',
        'cedulan.max' => 'Máximo 15 Cífras',
        'nombren.required' => 'Ingrese el Nombre',
        'nombren.max' => 'Máximo 50 caracteres',
        /* 'idlugarn' => 'Seleccione Lugar',
        'idtipopagon.required' => 'Seleccione Tipo de Pago',
        'idtipoabonon.required' => 'Seleccione Tipo de Abono', */
        'observaciones.required' => 'Ingrese Observaciones',
        'observaciones.max' => 'Máximo 250 letras',
        /* 'producto_idn.required' => 'SELECCIONE',
        'cantidadprorecmatn.required' => 'INGRESE',
        'cantidadprorecmatn.max' => 'MAXIMO 8 CIFRAS',
        'precionegn.required' => 'INGRESE',
        'totalpronegn.required' => 'SELECCIONE' */
    ];

    public function storem()    {   //AGREGA MATERIALES A LA LISTA  
        if(empty($this->producto_idn)){ $this->mostraremid='true';
        }else{ $this->mostraremid='false'; }
        if(empty($this->cantidadprorecmatn)){ $this->mostraremc='true';
        }else{ $this->mostraremc='false'; }
        if(empty($this->precionegn)){ $this->mostraremp='true';
        }else{ $this->mostraremp='false'; }
        if((!empty($this->producto_idn)) and (!empty($this->cantidadprorecmatn)) and (!empty($this->precionegn))){
            DetalleNegociacionCompra::create([
                'negociacion_id' => $this->recepcionmaterial_id,
                'producto_idn' => $this->producto_idn,
                'cantidadprorecmatn' => round((double)$this->cantidadprorecmatn,2),
                'precionegn' => round((double)$this->precionegn,2),
                'totalpronegn' => round((double)$this->totalpronegn,2),
                'cantidadprorecmatndebe' => round((double)$this->cantidadprorecmatn,2)
            ]);
            $datos = NegociacionCompra::find($this->recepcionmaterial_id);
            $datos->update(['cedulan' => (string)$this->cedulan]);
            $this->mostrard = "false"; $this->ocultarboton="false";
            $this->restapagoneg = (double)$this->restapagoneg+(double)$this->totalpronegn;
            $this->mostrarpagoneg='true';
            $this->mostraremid='false'; $this->mostraremc='false'; $this->mostraremp='false';
            $this->reset(['producto_idn', 'cantidadprorecmatn', 'precionegn', 'totalpronegn']);
            $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material agregado correctamente!']);
        }
    }

    public function destroy(DetalleNegociacionCompra $detallenegociacionventa){
        (double)$this->pmmdn=$detallenegociacionventa->totalpronegn;
        $this->restapagoneg = (double)$this->restapagoneg-(double)$detallenegociacionventa->totalpronegn;
        $detallenegociacionventa->delete();
        $productosrecepcion=DetalleNegociacionCompra::all()->where('negociacion_id', $this->recepcionmaterial_id)->count();
        if($productosrecepcion==0){ $this->mostrarpagoneg='false'; $this->mostrard = "true"; }
        $this->reset(['producto_idn', 'cantidadprorecmatn', 'precionegn', 'totalpronegn', 'pagoefectivoneg', 'pagotransfneg', 'totalpagoneg', 'restapagoneg']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado!']);
    }

    public $ocultarboton="false";
    public function calpeso(){ //CALCULA EL PESO NETO
        if((is_numeric($this->cantidadprorecmatn)) and (is_numeric($this->precionegn))){
            $this->totalpronegn=round((double)$this->cantidadprorecmatn * (double)$this->precionegn,2);
            $this->ocultarboton="true";
        }
        if(($this->cantidadprorecmatn==0) or ($this->precionegn==0)){
            $this->totalpronegn=0;
            $this->ocultarboton="false";
        }
    }

    public function traerprecio(){
        $preciopp = PreciosProveedores::where('cedula', $this->cedulan)
                                    ->where('idproducto', $this->producto_idn)
                                    ->pluck('precio');
        //dd($preciopp[0]);
        $this->precionegn = (double)$preciopp[0];
        $this->calpeso();
    }

    public $nopagar=true, $validamontotne, $validamontotnt;
    public function calrestaneg($montotn){ //CALCULA EL PAGO
        //dd($montotn);
        if((double)$montotn==0){
            $this->validamontotn="INGRESE MATERIALES";
        }elseif(round((double)$this->pagoefectivoneg,2)+round((double)$this->pagotransfneg,2)>round((double)$montotn,2)){
                $this->validamontotn="INGRESE UNA CANTIDAD MENOR O IGUAL AL TOTAL A PAGAR";
                /* $this->totalpagoneg=round((double)$this->pagoefectivoneg,2)+round((double)$this->pagotransfneg,2);
                $this->restapagoneg=round((double)$montotn)-round((double)$this->totalpagoneg,2);
                $this->nopagar=false; */
        }else{
/* dd(
     ' pagoefectivoneg   = '.(double)$this->pagoefectivoneg.'<br>'
    .' efectivodis       = '.(double)$this->efectivodis.'<br>'
    .' r pagoefectivoneg = '.round((double)$this->pagoefectivoneg).'<br>'
    .' r efectivodis     = '.round((double)$this->efectivodis).'<br>'
); */
             /* if(round((double)$this->pagoefectivoneg,2) or round((double)$this->pagotransfneg,2)){ */
                $this->validamontotn="";
                /* $this->totalpagoneg=round((double)$this->pagoefectivoneg,2)+round((double)$this->pagotransfneg,2);
                $this->restapagoneg=round((double)$montotn,2)-round((double)$this->totalpagoneg,2); */

               if(round((double)$this->pagoefectivoneg,2)>round((double)$this->efectivodis,2)){
                    $this->validamontotne="NO TIENE CAPACIDAD";
                    $this->nopagar=false;
                }else{ $this->nopagar=true; $this->validamontotne=""; } /* VALIDA EL BANCO */
                if(round((double)$this->pagotransfneg,2)>round((double)$this->bancodis,2)){
                    $this->validamontotnt="NO TIENE CAPACIDAD";
                    $this->nopagar=false;
                }else{ $this->nopagar=true; $this->validamontotnt=""; } /* VALIDA TOTAL DISPONIBLE */
                /* if(round((double)$this->totalpagoneg,2)>(round((double)$this->efectivodis,2)+round((double)$this->bancodis,2))){
                    $this->validamontotn="NO TIENE CAPACIDAD DE PAGO, INGRESE UNA CANTIDAD MENOR O IGUAL AL TOTAL DISPONIBLE";
                    $this->nopagar=false;
                }else{ $this->nopagar=true; } */
                /* aquí va el boton */
            /* } */
        }
    }

    public function busproc(){ //BUSCA LOS PROVEEDORES
        $probc=Proveedores::where('cedula',$this->cedulan)->get()->pluck('nombre');
        $this->nombren = isset($probc) ? $probc : "NO EXISTE";
    }

    public function buspron(){ //BUSCA LOS PROVEEDORES
        $probn=Proveedores::where('nombre',$this->nombren)->get()->pluck('cedula');
        $this->cedulan = isset($probn) ? $probn : "NO EXISTE";
    }

    public function traedesmaterial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['descripcion'];
        return $this->muesdesmaterial;
    }

    public function generar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES
        $nrm = NegociacionCompra::count();
        if($nrm==0){ $nrm = 1; }else{ ++$nrm; }       
        $datos = NegociacionCompra::create([
            'id' => $nrm,
            'fechan' => date('d-m-Y'),
            'horan' => date("H:i:s"),
            'cedulan' => (string)$this->cedulan,
            'idlugarn' => 0,
            'idtipopagon' => 0,
            'idtipoabonon' => 0,
            'observaciones' => '',
            'montotn' => (double)0,
            'efectivo' => (double)0,
            'transferencia' => (double)0,
            'totalpagado' => (double)0,
            'pesotn' => (double)0,
            'restan' => (double)0,
            'finalizada' => 'NO',
            'amortizando' => 2,
        ]);
        $this->mostrar = "true"; $this->mostrarm = "true"; $this->mostrard = "true";
        $recepcion = NegociacionCompra::latest('id')->first();
        $this->recepcionmaterial_id=$recepcion->id;
        /* session(['ptn' => 0]); session(['pfn' => 0]); */
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Negociación Generada']);
    }

    public $totalpagonegven, $productosnegociacion;
    public function update($recepcionmaterial_id){        
        $this->validate();
        $nc = DetalleNegociacionCompra::where('negociacion_id',$recepcionmaterial_id)->get()->count();
        if($nc==0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Agrege Materiales para Guardar la Negociación']);
        }else{
            $this->fecha = date('d-m-Y');
            $datos = NegociacionCompra::find($recepcionmaterial_id);
            /* $datos = NegociacionCompra::all()->where('negociacion_id', $this->recepcionmaterial_id); */
            $productosrecepcion=DetalleNegociacionCompra::all()->where('negociacion_id', $this->recepcionmaterial_id);
            foreach ($productosrecepcion as $dtosd){
                $this->pesotn=$this->pesotn+$dtosd->cantidadprorecmatn;
                $this->montotn=$this->montotn+$dtosd->totalpronegn;
                //ACTUALIZA LA CPP EN LA TABLA CUENTAS MATERIAL
                $cuentamaterial=CuentasMaterial::where('idproducto', $dtosd->producto_idn)->get()->pluck('id');
                $cuentamaterial=CuentasMaterial::find($cuentamaterial[0]);
                $cmcpp=(double)$cuentamaterial->cpp+(double)$dtosd->cantidadprorecmatn;
                $cuentamaterial->update([
                    'cpp' => $cmcpp
                ]); //FIN ACTUALIZA LA CPP EN LA TABLA CUENTAS MATERIAL
            } //DETERMINA EL TIPO DE PAGO
            if($this->restapagoneg==0){ $idtipopagon=1; }else{ $idtipopagon=2; }
              //DETERMINA EL TIPO DE ABONO
            if($this->pagoefectivoneg>0){ $idtipoabonon=1; }
            if($this->pagotransfneg>0){ $idtipoabonon=2; }
            if($this->pagotransfneg>0 and $this->pagoefectivoneg>0){ $idtipoabonon=3; }
            if($this->pagotransfneg=="" and $this->pagoefectivoneg==""){ $idtipoabonon=0; }
            $this->productosnegociacion=(double)$productosrecepcion->sum('cantidadprorecmatn');
            $this->totalpagonegven=(double)$this->pagoefectivoneg+(double)$this->pagotransfneg;
            /* $datos = NegociacionCompra::where('id', $this->recepcionmaterial_id)->get()->pluck('id');
            $datos = NegociacionCompra::find($datos[0]); */
            $datos->update([
                'fechan' => date('d-m-Y'),
                'horan' => date("H:i:s"),
                'cedulan' => (string)$this->cedulan,
                'idtipopagon' => $idtipopagon,
                'idtipoabonon' => $idtipoabonon,
                'observaciones' => $this->observaciones,
                'montotn' => (double)$productosrecepcion->sum('totalpronegn'),
                'efectivo' => (double)$this->pagoefectivoneg,
                'transferencia' => (double)$this->pagotransfneg,
                'totalpagado' => (double)$this->totalpagonegven,
                'pesotn' => (double)$this->productosnegociacion,
                'restan' => (double)$this->restapagoneg,
                'finalizada' => 'NO',
                'amortizando' => 2
            ]); //LA FACTURA SE GENERA DESDE LA BASE DE DATOS CON UN TRIGER
            $this->mostrard = "false";
            $this->mostrar = "false"; $this->mostrarm = "false"; $this->mostrarpagoneg = 'false';
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Negociación Actualizada!']);
            $this->reset();
        }
    }
    
    public function default($recepcionmaterial_id)    {
        $nc = DetalleNegociacionCompra::where('negociacion_id',$recepcionmaterial_id)->get()->count();
        if($nc>0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Elimine los Materiales para poder Cancelar la Negociación']);
        }else{
            $user = NegociacionCompra::findOrFail($recepcionmaterial_id);
            $user->delete();
            /* session(['ptn' => 0]); session(['pfn' => 0]);
            $this->vpeso = "false"; */
            $this->mostrard = "false";
            $this->mostrar = "false"; $this->mostrarm = "false"; $this->mostrarpagoneg = 'false';
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Negociación  Eliminada!']);
            $this->reset(['fechan', 'cedulan', 'nombren', 'idtipopagon', 'idtipoabonon', 'observaciones', 'negociacion_id', 'producto_idn', 'cantidadprorecmatn', 'precionegn', 'totalpronegn', 'recepcionmaterial_id', 'messages', 'pesotn', 'montotn', 'pagoefectivoneg', 'pagotransfneg', 'restapagoneg', 'totalpagoneg']);
        }
    }
    
    public $efectivodis, $bancodis;
    public function render()
    {
        //$recepcionmaterial_id=7;
        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::where('id', '<>', 1)->get();
        $recepcion = NegociacionCompra::latest('id')->first();
        $materiales = Material::all();
        $este=$this->recepcion;                                    
        $productosrecepcion=DetalleNegociacionCompra::all()->where('negociacion_id',$this->recepcionmaterial_id);
        $this->efectivodis = Liquidez::where('id', 1)->get()->pluck('efectivo')[0];
        $this->bancodis = Liquidez::where('id', 1)->get()->pluck('banco')[0];
        /* $productosrecepcion=DetalleVenta::all()->where('idventa',$this->recepcionmaterial_id); */

        //dd($efectivodis[0]);
        return view('livewire.compras.negociacion', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion'/* , 'traesuma' */));
    }
}
