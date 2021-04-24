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
    
    public $mostraremidc='false', $mostraremc='false', $mostrarempc='false', $pesotnc=0, $montotnc;
    public $negociacion_id, $producto_idnc, $cantidadprorecmatnc, $precionegnc, $totalpronegnc;
    public $fechanc, $cedulanc, $nombrenc, $idlugarnc, $idtipopagonc, $idtipoabononc, $required, $observacionesc, $preciopron, $totalcalculadoc;
    public $fecha, $cedula, $idlugar, $pesofull, $pesovacio, $pesoneto, $almacen_id;
    public $recepcion, $idnegociacioncomprac, $producto_id, $cantidadprorecmat, $operacion, $detalmacen_id;
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
    public $vclose, $vpesoc = "false", $pesoic;
    public $ptg, $ptf, $pmm;
    public $editm_id, $traesuma='NO', $mostrarc='false', $mostrarmc='false';
    public $idtipopagonegc, $pagoefectivonegc, $pagotransfnegc, $totalpagonegc, $restapagonegc, $validamontotnc, $mostrarpagonegc='false', $mostrardc = "false";
    public $nopagarc="false", $sumapagoc, $validamontotnec, $validamontotntc;
    public $ocultarbotongc='false'; 

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    protected $rules = [
        //'fechan' => 'required',
        'cedulanc' => 'required|max:15',
        'nombrenc' => 'required|max:50',
        /* 'idlugarn' => 'required',
        'idtipopagon' => 'required',
        'idtipoabonon' => 'required', */
        'observacionesc' => 'required|max:250',
        /* 'producto_idnc' => 'required',
        'cantidadprorecmatnc' => 'required|max:8',
        'precionegn' => 'required|max:8', */
    ];

    protected $validationattributs = [
        //'fechan' => 'Fecha',
        'cedulanc' => 'Cédula',
        'nombrenc' => 'Nombre',
        /* 'idlugarn' => 'Lugar',
        'idtipopagon' => 'Tipo de Pago',
        'idtipoabonon' => 'Tipo de Abono', */
        'observacionesc' => 'Observaciones',
        /* 'producto_idnc' => 'Material',
        'cantidadprorecmatnc' => 'Cantidad',
        'precionegn' => 'Precio', */
    ];

    protected $messages = [
        'cedulanc.required' => 'Ingrese la Cédula',
        'cedulanc.max' => 'Máximo 15 Cífras',
        'nombrenc.required' => 'Ingrese el Nombre',
        'nombrenc.max' => 'Máximo 50 caracteres',
        /* 'idlugarn' => 'Seleccione Lugar',
        'idtipopagon.required' => 'Seleccione Tipo de Pago',
        'idtipoabonon.required' => 'Seleccione Tipo de Abono', */
        'observacionesc.required' => 'Ingrese Observaciones',
        'observacionesc.max' => 'Máximo 250 letras',
        /* 'producto_idnc.required' => 'SELECCIONE',
        'cantidadprorecmatnc.required' => 'INGRESE',
        'cantidadprorecmatnc.max' => 'MAXIMO 8 CIFRAS',
        'precionegn.required' => 'INGRESE',
        'totalpronegn.required' => 'SELECCIONE' */
    ];

    public function storem()    {   //AGREGA MATERIALES A LA LISTA  
        if(empty($this->producto_idnc)){ $this->mostraremidc='true';
        }else{ $this->mostraremidc='false'; }
        if(empty($this->cantidadprorecmatnc)){ $this->mostraremc='true';
        }else{ $this->mostraremc='false'; }
        if(empty($this->precionegnc)){ $this->mostrarempc='true';
        }else{ $this->mostrarempc='false'; }
        if((!empty($this->producto_idnc)) and (!empty($this->cantidadprorecmatnc)) and (!empty($this->precionegnc))){
            DetalleNegociacionCompra::create([
                'negociacion_id' => $this->idnegociacioncomprac,
                'producto_idn' => $this->producto_idnc,
                'cantidadprorecmatn' => round((double)$this->cantidadprorecmatnc,2),
                'precionegn' => round((double)$this->precionegnc,2),
                'totalpronegn' => round((double)$this->totalpronegnc,2),
                'cantidadprorecmatndebe' => round((double)$this->cantidadprorecmatnc,2)
            ]);
            /* $datos = NegociacionCompra::find($this->idnegociacioncomprac);
            $datos->update(['cedulan' => (string)$this->cedulanc]); */
            $this->mostrardc = "false"; $this->ocultarbotonc="false";
            $this->montotnc = round((double)$this->restapagonegc+(double)$this->totalpronegnc,2);
            $this->restapagonegc = round((double)$this->montotnc,2);
            $this->mostrarpagonegc='true'; $this->nopagarc="true";
            $this->mostraremidc='false'; $this->mostraremc='false'; $this->mostrarempc='false';
            auditar('COMPRA - NEGOCIACION #: '.$this->idnegociacioncomprac, 'AGREGAR MATERIAL');
            $this->reset(['producto_idnc', 'cantidadprorecmatnc', 'precionegnc', 'totalpronegnc']);
            $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material agregado correctamente!']);
        }
    }

    public function destroy(DetalleNegociacionCompra $detallenegociacionventac){
        (double)$this->pmmdnc=$detallenegociacionventac->totalpronegn;
        $this->montotnc = round((double)$this->montotnc-(double)$detallenegociacionventac->totalpronegn,2);
        $this->restapagonegc = round((double)$this->montotnc,2);
        /* $this->restapagonegc = (double)$this->restapagonegc-(double)$detallenegociacionventac->totalpronegn; */
        $detallenegociacionventac->delete();
        $productosrecepcionc=DetalleNegociacionCompra::all()->where('negociacion_id', $this->idnegociacioncomprac)->count();
        if($productosrecepcionc==0){ $this->mostrarpagonegc='false'; $this->mostrardc = "true"; $this->nopagarc="false"; }
        auditar('COMPRA - NEGOCIACION #: '.$this->idnegociacioncomprac, 'ELIMINAR MATERIAL');
        $this->reset(['producto_idnc', 'cantidadprorecmatnc', 'precionegnc', 'totalpronegnc'/* , 'pagoefectivonegc', 'pagotransfnegc', 'totalpagonegc', 'restapagonegc' */]);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado!']);
    }

    public $ocultarbotonc="false";
    public function calpeso(){ //CALCULA EL PESO NETO
        if((is_numeric($this->cantidadprorecmatnc)) and (is_numeric($this->precionegnc))){
            $this->totalpronegnc=round((double)$this->cantidadprorecmatnc * (double)$this->precionegnc,2);
            $this->ocultarbotonc="true";
        }
        if(($this->cantidadprorecmatnc==0) or ($this->precionegnc==0)){
            $this->totalpronegnc=0;
            $this->ocultarbotonc="false";
        }
    }

    public function traerprecioc(){
        $precioppc = PreciosProveedores::where('cedula', $this->cedulanc)
                                    ->where('idproducto', $this->producto_idnc)
                                    ->pluck('precio');
        //dd($preciopp[0]);
        $this->precionegnc = (double)$precioppc[0];
        $this->calpeso();
    }

    /* public function calrestanegc($restanc){ //CALCULA EL RESTO DE LA NEGOCIACION */
    public function calrestanegc(){ //CALCULA EL RESTO DE LA NEGOCIACION
        $this->restapagonegc=$this->montotnc;
        if((double)$this->restapagonegc==0){
            $this->validamontotnc="NO DEBE"; $this->totalpagonegc=0; $this->restapagonegc=0;
        }elseif(((double)$this->pagoefectivonegc+(double)$this->pagotransfnegc)>(double)$this->restapagonegc){
                $this->validamontotnc="TOTAL DEBE SER MENOR O IGUAL A: ".(double)$this->restapagonegc;
                $this->totalpagonegc=round((double)$this->pagoefectivonegc + (double)$this->pagotransfnegc,2);
                $this->restapagonegc=round((double)$this->restapagonegc-(double)$this->totalpagonegc,2);
                /* $this->ocultarbotonc="false";  */$this->nopagarc="true";
        }else{
            if((is_numeric((double)$this->pagoefectivonegc)) or (is_numeric((double)$this->pagotransfnegc))){
                //$idtipopagoneg, $pagoefectivonegc, $pagotransfnegc, $totalpagonegc;
                $this->validamontotnc="";
                $this->totalpagonegc=(double)$this->pagoefectivonegc + (double)$this->pagotransfnegc;
                $this->restapagonegc=(double)$this->restapagonegc-(double)$this->totalpagonegc;
                /* $this->ocultarbotonc="true";  */$this->nopagarc="false";
            }
        }
        if($this->totalpagonegc==0){ $this->ocultarbotonc="false"; }
        if((double)$this->pagoefectivonegc>(double)$this->efectivodisc){
            $this->validamontotnec="EXEDIDO"; $this->nopagarc="false";
        }else{ $this->nopagarc="true"; $this->validamontotnec=""; } /* VALIDA EL BANCO */
        if((double)$this->pagotransfnegc>(double)$this->bancodisc){
            $this->validamontotntc="EXEDIDO"; $this->nopagarc="false";
        }else{ $this->nopagarc="true"; $this->validamontotntc=""; } /* VALIDA TOTAL DISPONIBLE */
        if((double)$this->totalpagonegc>((double)$this->efectivodisc+(double)$this->bancodisc)){
            $this->validamontotn="NO TIENE CAPACIDAD DE PAGO, INGRESE UNA CANTIDAD MENOR";
            $this->nopagarc="false";
        }else{ $this->nopagarc="true"; }
    }

    public function busproc(){ //BUSCA LOS PROVEEDORES
        $probc=Proveedores::where('cedula',$this->cedulanc)->get()->pluck('nombre');
        $this->nombrenc = isset($probc) ? $probc : "NO EXISTE";
    }

    public function buspron(){ //BUSCA LOS PROVEEDORES
        $probnc=Proveedores::where('nombre',$this->nombrenc)->get()->pluck('cedula');
        $this->cedulanc = isset($probnc) ? $probnc : "NO EXISTE";
    }

    public function traedesmaterial($idc){
        $probc=Producto::find($idc);
        $this->muesdesmaterialc=$probc['descripcion'];
        return $this->muesdesmaterialc;
    }

    public function generar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES
        $nrmc = NegociacionCompra::count();
        if($nrmc==0){ $nrmc = 1; }else{ ++$nrmc; }       
        $datos = NegociacionCompra::create([
            'id' => $nrmc,
            'fechan' => date('d-m-Y'),
            'horan' => date("H:i:s"),
            'cedulan' => (string)$this->cedulanc,
            'idlugarn' => 1,
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
        $this->mostrarc = "true"; $this->mostrarmc = "true"; $this->mostrardc = "true";
        $recepcionc = NegociacionCompra::latest('id')->first();
        $this->idnegociacioncomprac=$recepcionc->id;
        /* session(['ptn' => 0]); session(['pfn' => 0]); */
        auditar('COMPRA - NEGOCIACION #: '.$this->idnegociacioncomprac, 'GENERAR');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Negociación Generada']);
    }

    public $totalpagonegvenc, $productosnegociacionc;
    public function update($idnegociacioncomprac){ //ACTUALIZA LA NEGOCIACION DE COMPRA
        $this->validate();
        $ncc = DetalleNegociacionCompra::where('negociacion_id',$idnegociacioncomprac)->get()->count();
        if($ncc==0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Agrege Materiales para Guardar la Negociación']);
        }else{
            $productosrecepcionc=DetalleNegociacionCompra::all()->where('negociacion_id', $idnegociacioncomprac);
            foreach ($productosrecepcionc as $dtosdc){
                $this->pesotnc=$this->pesotnc+$dtosdc->cantidadprorecmatn;
                $this->montotnc=$this->montotnc+$dtosdc->totalpronegn;
                //ACTUALIZA LA CPC EN LA TABLA CUENTAS MATERIAL
                $cuentamaterialc=CuentasMaterial::find($dtosdc->producto_idn);
                $cmcpc=(double)$cuentamaterialc->cpc+(double)$dtosdc->cantidadprorecmatn;
                $cuentamaterialc->update(['cpc' => $cmcpc]); //FIN ACTUALIZA LA CPC EN LA TABLA CUENTAS MATERIAL
            } //DETERMINA EL TIPO DE PAGO
            if($this->restapagonegc==0){ $idtipopagonc=1; }else{ $idtipopagonc=2; } //DETERMINA EL ESTATUS DE PAGO Y TIPO DE ABONO
            if($this->pagoefectivonegc>0){ $idtipoabononc=1; } //PAGO EN EFECTIVO
            if($this->pagotransfnegc>0){ $idtipoabononc=2; } //PAGO POR TRANSFERENCIA
            if($this->pagotransfnegc>0 and $this->pagoefectivonegc>0){ $idtipoabononc=3; }  //PAGO EN EFECTIVO Y POR TRANSFERENCIA
            if($this->pagotransfnegc=="" and $this->pagoefectivonegc==""){ $idtipoabononc=0; } //NO PAGO
            $this->productosnegociacionc=(double)$productosrecepcionc->sum('cantidadprorecmatn'); //
            $this->totalpagonegvenc=(double)$this->pagoefectivonegc+(double)$this->pagotransfnegc;
            $datoscompras=NegociacionCompra::find($idnegociacioncomprac);
            $datoscompras->update([
                'fechan' => date('d-m-Y'),
                'horan' => date("H:i:s"),
                'cedulan' => (string)$this->cedulanc,
                'idlugarn' => 1,
                'idtipopagon' => $idtipopagonc,
                'idtipoabonon' => $idtipoabononc,
                'observaciones' => $this->observacionesc,
                'montotn' => (double)$productosrecepcionc->sum('totalpronegn'), //OJO VERIFICAR
                'efectivo' => (double)$this->pagoefectivonegc,
                'transferencia' => (double)$this->pagotransfnegc,
                'totalpagado' => (double)$this->totalpagonegvenc,
                'pesotn' => (double)$this->productosnegociacionc,
                'restan' => (double)$this->restapagonegc,
                'finalizada' => 'NO',
                'amortizando' => 2
            ]); //LA FACTURA SE GENERA DESDE LA BASE DE DATOS CON UN TRIGER
            $this->mostrardc = "false";
            $this->mostrarc = "false"; $this->mostrarmc = "false"; $this->mostrarpagonegc = 'false';
            auditar('COMPRA - NEGOCIACION #: '.$this->idnegociacioncomprac, 'GUARDAR');
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Negociación Actualizada!']);
            $this->reset();
        }
    }
    
    public function default($idnegociacioncomprac)    {
        $ncc = DetalleNegociacionCompra::where('negociacion_id',$idnegociacioncomprac)->get()->count();
        if($ncc>0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Elimine los Materiales para poder Cancelar la Negociación']);
        }else{
            $user = NegociacionCompra::findOrFail($idnegociacioncomprac);
            $user->delete();
            /* session(['ptn' => 0]); session(['pfn' => 0]);
            $this->vpeso = "false"; */
            $this->mostrardc = "false";
            $this->mostrarc = "false"; $this->mostrarmc = "false"; $this->mostrarpagonegc = 'false';
            auditar('COMPRA - NEGOCIACION #: '.$this->idnegociacioncomprac, 'CANCELAR');
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Negociación  Eliminada!']);
            $this->reset();
            /* $this->reset(['fechanc', 'cedulanc', 'nombrenc', 'idtipopagonc', 'idtipoabononc', 'observacionesc', 'negociacion_id', 'producto_idnc', 'cantidadprorecmatnc', 'precionegnc', 'totalpronegnc', 'idnegociacioncomprac', 'messages', 'pesotnc', 'montotnc', 'pagoefectivonegc', 'pagotransfnegc', 'restapagonegc', 'totalpagonegc']); */
        }
    }
    
    public $efectivodisc, $bancodisc;
    public function render()
    {
        //$idnegociacioncomprac=7;
        $vendedoresc = Proveedores::all();
        $lugaresc = Sucursal::all();
        $productosc = Producto::where('id', '<>', 1)->get();
        $recepcionc = NegociacionCompra::latest('id')->first();
        $materialesc = Material::all();
        $estec=$this->recepcion;                                    
        $productosrecepcionc=DetalleNegociacionCompra::all()->where('negociacion_id',$this->idnegociacioncomprac);
        $this->efectivodisc = Liquidez::where('id', 1)->get()->pluck('efectivo')[0];
        $this->bancodisc = Liquidez::where('id', 1)->get()->pluck('banco')[0];
        /* $productosrecepcion=DetalleVenta::all()->where('idventa',$this->idnegociacioncomprac); */

        //dd($efectivodis[0]);
        return view('livewire.compras.negociacion', [
                    'materiales'=>$materialesc,
            ], compact('vendedoresc', 'lugaresc', 'productosc', 'recepcionc', 'productosrecepcionc'/* , 'traesuma' */));
    }
}
