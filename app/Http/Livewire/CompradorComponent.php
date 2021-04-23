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
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
//use App\Http\Livewire\Almacen\Request;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Cache;
use App\Http\Livewire\Input;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Http\Livewire\Compras;
use App\Models\ConsultaAmortizacionNegociacionCompra;
use App\Models\ConsultaTraerRecepcionComprar;
use App\Models\CuentasPorPagarCompras;
use App\Models\DetalleCuentasPorPagarCompras;
use App\Models\Liquidez;
use App\Models\PreciosProveedores;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CompradorComponent extends Component
{
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
    public $cantpro, $totalcalculado, $sobregiro, $vpeso, $recepciones;
    public $probc, $muesdesmaterial, $mostrar = "false", $mostrarm = "false";
    public $nomostrarcalculopremantabpro="false", $mostrarpagoventas='false', $montotnc;
    public $efectivodisc, $bancodisc, $validamontotneventas, $validamontotntventas, $validamontotventas, $pagoefectivoventas, $pagotransfventas, $restapagoventas, $mostrarcalpagoventas, $totalpagoventas, $nopagarventas="true";

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $estate = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    protected $rules = [
        'state.idestatuspago' => 'required',
        'state.idtipopago' => 'required',
        'state.observacionesc' => 'required',
        'state.totalpagado' => 'required'
    ];

    protected $validationattributs = [
        'state.idestatuspago' => 'Estatus de Pago',
        'state.idtipopago' => 'Tipo de Pago',
        'state.observacionesc' => 'Observaciones',
        'state.totalpagado' => 'Total a Pagar'
    ];

    protected $messages = [
        'state.idestatuspago.required' => 'Seleccione Estatus de Pago.',
        'state.idtipopago.required' => 'Seleccione Tipo de Pago.',
        'state.observacionesc.required' => 'Ingrese Observaciones',
        'state.observacionesc.max' => 'Máximo 250 letras',
        'state.totalpagado.required' => 'Ingrese Total a Pagar'
    ];

    public function createUser(){
        $this->validate();
        Material::create([
            'recepcionmaterial_id' => $this->recepcionmaterial_id,
            'producto_id' => $this->state['producto_id'],
            'cantidadprorecmat' => $this->state['cantidadprorecmat'],
            'operacion' => $this->state['operacion']
        ]);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material agregado correctamente!']);
    }

    public function edit(Material $user){
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser(){
        $validateData = Validator::make($this->state, [
            'producto_id' => 'required',
            'cantidadprorecmat' => 'required|max:8',
        ])->validate();
        $this->user->update($validateData);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material actualizado correctamente!']);
    }

    public function confirmUserRemoval($userId){
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser(){
        $user = Material::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Usuario Eliminado!']);
    }

    public function calpeso(){ //CALCULA EL PESO NETO
        if($this->pesofull<>NULL and $this->pesovacio<>NULL){
            if($this->pesofull>=1 or $this->pesovacio>=1){
                if($this->pesofull>$this->pesovacio){
                    $this->pesoneto=$this->pesofull-$this->pesovacio;
                    $this->pesodisponible=$this->pesofull-$this->pesovacio;
                    $this->pesodisponiblec=$this->pesodisponible;
                }else{ $this->pesoneto="PESO FULL <= PESO VACIO"; }
            }
        }
        if($this->pesofull==NULL){ $this->pesoneto="Ingrese PESO FULL"; }
        if($this->pesovacio==NULL){ 
            $this->pesoneto=$this->pesofull;
            $this->pesodisponible=$this->pesofull; 
            $this->pesodisponiblec=$this->pesodisponible; }
    }

    public function calpreind($numero, $cantpro){ /* PRECIOS MANUALES */
        (double)$this->totalcalculado=0;
        if(is_numeric($this->{"precio".$numero})){
            /* (double)$this->{"toprod".$numero}=(double)$this->{"cantidadp".$numero} * (double)$this->{"precio".$numero}; */
            (double)$this->{"toprod".$numero}=(double)session("cantidadp".$numero) * (double)$this->{"precio".$numero};
            for($i=1;$i<=$cantpro;$i++){
                (double)$this->totalcalculado=(double)$this->totalcalculado+$this->{"toprod".$i};
            }
        }
    }
    
    public function caldiferencia(){ //CALCULA LA DIFERENCIA DE PAGO
        (double)$this->state['diferenciapago']=0;
        if(is_numeric($this->state['totalpagado'])){
            (double)$this->state['diferenciapago'] = (double)$this->totalcalculado - (double)$this->state['totalpagado'];
            session('totalpagado',(double)$this->state['totalpagado']);
            session('diferenciapago',(double)$this->state['diferenciapago']);
            if((double)$this->state['totalpagado']<=(double)$this->totalcalculado){
                $this->vpeso = "false";
                $this->sobregiro=" ";
            }else{
                $this->vpeso = "true";
                $this->sobregiro="NO DEBE PAGAR MAS DEL TOTAL";
            }
        }
    }
    
    public function calrestaventas(){ //CALCULA EL RESTO DE LA NEGOCIACION
        $this->restapagoventas=session('toprodacum');
        if((double)$this->restapagoventas==0){
            $this->validamontotnventas="NO DEBE"; $this->totalpagoventas=0; $this->restapagoventas=0;
        }elseif(((double)$this->pagoefectivoventas+(double)$this->pagotransfventas)>(double)$this->restapagoventas){
                $this->validamontotventas="TOTAL DEBE SER MENOR O IGUAL A: ".(double)$this->restapagoventas;
                $this->totalpagoventas=round((double)$this->pagoefectivoventas + (double)$this->pagotransfventas,2);
                $this->restapagoventas=round((double)$this->restapagoventas-(double)$this->totalpagoventas,2);
                /* $this->ocultarbotonc="false";  */$this->nopagarventas="true";
        }else{
            if((is_numeric((double)$this->pagoefectivoventas)) or (is_numeric((double)$this->pagotransfventas))){
                //$idtipopagoneg, $pagoefectivoventas, $pagotransfventas, $totalpagoventas;
                $this->validamontotventas="";
                $this->totalpagoventas=(double)$this->pagoefectivoventas + (double)$this->pagotransfventas;
                $this->restapagoventas=(double)$this->restapagoventas-(double)$this->totalpagoventas;
                /* $this->ocultarbotonc="true";  */$this->nopagarventas="false";
            }
        }
        if($this->totalpagoventas==0){ $this->ocultarbotonventas="false"; }
        if((double)$this->pagoefectivoventas>(double)$this->efectivodisc){
            $this->validamontotneventas="EXEDIDO"; $this->nopagarventas="false";
        }else{ $this->nopagarventas="true"; $this->validamontotneventas=""; } /* VALIDA EL BANCO */
        if((double)$this->pagotransfventas>(double)$this->bancodisc){
            $this->validamontotntventas="EXEDIDO"; $this->nopagarventas="false";
        }else{ $this->nopagarventas="true"; $this->validamontotntventas=""; } /* VALIDA TOTAL DISPONIBLE */
        if((double)$this->totalpagoventas>((double)$this->efectivodisc+(double)$this->bancodisc)){
            $this->validamontotventas="NO TIENE CAPACIDAD DE PAGO, INGRESE UNA CANTIDAD MENOR";
            $this->nopagarventas="false";
        }else{ $this->nopagarventas="true"; }
    }
    
    public function verificarpeso(){ //CALCULA EL PESO DISPONIBLE
        if($this->pesodisponiblec > $this->state['cantidadprorecmat']){
            $this->close = "true";
            $this->pesodisponiblec = $this->pesodisponible - (double)$this->state['cantidadprorecmat'];
            $this->acumuladoc = $this->acumulado + (double)$this->state['cantidadprorecmat'];
        }else{ 
            $this->close = "false";
            $this->pesodisponiblec=(string)$this->pesodisponible." INSUFICIENTE";
            $this->acumuladoc = $this->acumulado;
        }
    }

    //no se está usando los datos se buscan directo en la vista
    public function busnumalcompra(){ //BUSCA LOS DATOS DEL ALMACEN
        dd($this->recepcionmaterial_id);
        $nc = Almacen::count();
        /* $nc = Almacen::latest('id')->first(); */
        /* $nc = Almacen::find($idalmacen); */
        if($nc->count()>0){ 
            /* if($nr['id']==0){ $nrm = 1; }else{ $nrm=$nr['id']+1; } */
            /* if($this->recepcionmaterial_id>$nc){ */ 
            if($this->recepcionmaterial_id>$nc['id']){
                $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'El número de Almacen '.$this->recepcionmaterial_id.' no se ha creado']);
                $this->datalm=""; $this->limpiar();
            }elseif(($this->recepcionmaterial_id>0) and ($this->recepcionmaterial_id<=$nc)){
                $datalm = Almacen::find($this->recepcionmaterial_id);
                if($datalm->facturado=="NO"){
                    $datalm = Almacen::find($this->recepcionmaterial_id);
                    $this->fecha = isset($datalm->fecha) ? $datalm->fecha : "";
                    $this->cedula = isset($datalm->cedula) ? $datalm->cedula : "";
                    $datalmn=Proveedores::where('cedula',$datalm->cedula)->get()->pluck('nombre');
                    $this->nombre = isset($datalmn) ? $datalmn : "";
                    $datalml=Sucursal::where('id',$datalm->idlugar)->get()->pluck('descripcion');
                    $this->idlugar = isset($datalml) ? $datalml : "";
                    $this->pesofull = isset($datalm->pesofull) ? $datalm->pesofull : "";
                    $this->pesovacio = isset($datalm->pesovacio) ? $datalm->pesovacio : "";
                    $this->pesoneto = isset($datalm->pesoneto) ? $datalm->pesoneto : "";
                    $this->pesocalculado = isset($datalm->pesocalculado) ? $datalm->pesocalculado : "";
                    $this->observaciones = isset($datalm->observaciones) ? $datalm->observaciones : "";
                }else{
                    $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'El número de Almacen '.$this->recepcionmaterial_id.' ya fue procesado']);
                    $this->datalm=""; $this->limpiar();
                }
            }else{ $this->limpiar(); }
        }
    }
    
    public function buspron(){ //BUSCA LOS PROVEEDORES
        $probn=Proveedores::where('nombre',$this->nombre)->get()->pluck('cedula');
        $this->cedula = isset($probn) ? $probn : "";
    }

    public function traedesmaterial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['descripcion'];
        return $this->muesdesmaterial;
    }

    public function traeprematerial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['precio'];
        return $this->muesdesmaterial;
    }

    public function traeprematerialcliente($cedula, $idproducto){
        $probc= PreciosProveedores::where('cedula', $cedula)->where('idproducto', $idproducto)->get()/* ->pluck('precio')[0] */;
        //dd($probc[0]->precio);
        $this->muesdesmaterial=$probc[0]->precio;
        return $this->muesdesmaterial;
    }
    
    public $mostrarcompra="false";
    public function generar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES       
        /* if(!is_null($this->recepcionmaterial_id)){ */
        $nc = Compra::count();
        if($nc==0){ $nc = 1; }else{ ++$nc; }
        //$recepcion = Almacen::find($this->recepcionmaterial_id);
        $datosc = Compra::create([
            'id' => $nc,           
            /* 'idrecepcion' => $this->recepcionmaterial_id, */
            /* 'fecharecepcion' => $recepcion->fecha,
            'fechacompra' => $this->fechacompra,
            'hora' => $this->hora, */
            /* 'cedula' => $recepcion->cedula,
            'idlugar' => $recepcion->idlugar, */
            'idestatuspago' => 0,
            'idtipopago' => 0,
            'totalcomra' => 0,
            'totalpagado' => 0,
            'diferenciapago' => 0,
            'observacionesc' => 'NINGUNA'
        ]);
        $compra = Compra::latest('id')->first();
        $this->compra=$compra->id; $this->mostrarcompra="true";
        $this->mostrar = "true"; $this->mostrarm = "true"; $this->mostrarpagoventas='true';
        auditar('COMPRA #: '.$this->compra, 'GENERAR');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Compra de Material Generada']);
        /* }else{
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Ingrese el número de Almacen ']);
            $this->datalm=""; $this->limpiar();
        } */
    }

    public function update($compra, $productosrecepcion, $totalcalculado){
        //$this->validate();

        if($this->pagoefectivoventas>0){ $idtipoabonoven=1; }
        if($this->pagotransfventas>0){ $idtipoabonoven=2; }
        if($this->pagotransfventas>0 and $this->pagoefectivoventas>0){ $idtipoabonoven=3; }
        if($this->pagotransfventas=="" and $this->pagoefectivoventas==""){ $idtipoabonoven=0; }
        if($this->restapagoventas>0){ $this->idtipopagoventas=2; $this->idestatuspagoventas=2;
        }else{ $this->idtipopagoventas=1; $this->idestatuspagoventas=1; }
        
        if($this->idtipopagoventas==1){ //PAGO DE CONTADO
            $recepcion = Almacen::find($this->recepcionmaterial_id);
            $datosc = Compra::find($compra);
            $datosc->update([
                'idrecepcion' => $this->recepcionmaterial_id,
                'fecharecepcion' => $recepcion->fecha,
                'fechacompra' => date('d-m-Y'),
                'hora' => date("H:i:s"),
                'idestatuspago' => $this->idestatuspagoventas,
                'idtipopago' => $this->idtipopagoventas,
                'efectivo' => (double)$this->pagoefectivoventas,
                'transferencia' => (double)$this->pagotransfventas,
                'idtipoabonov' => $idtipoabonoven,
                'totalcomra' => (double)session('toprodacum'),
                'totalpagado' =>(double)$this->totalpagoventas,
                'diferenciapago' => (double)$this->restapagoventas,
                'observacionesc' => $this->observacionesc
            ]); //ACTUALIZA LA LIQUIDEZ
            $liquidez = Liquidez::find(1);
            $this->actefectivo=(double)$liquidez->efectivo-(double)$this->pagoefectivoven;
            $this->acttransferencia=(double)$liquidez->banco-(double)$this->pagotransfven;
            $liquidez->update([
                'efectivo' => (double)$this->actefectivo,
                'banco' => (double)$this->acttransferencia
            ]); //ACTUALIZA EL INVENTARIO
            $recepcion->update(['facturado' => 'SI']);
            foreach ($productosrecepcion as $productocompra){
                $this->i=$this->i+1;
                $datosdc = DetalleComprador::create([
                   'idcompra' => $compra,
                   'idproducto' => $productocompra['producto_id'],
                   'cantidadpro' => $productocompra['cantidadprorecmat'],
                   'operacion' => $productocompra['operacion'],
                   'preciopro' => (double)$this->{"precio".$this->i},
                   'totalpro' => (double)$this->{"toprod".$this->i}
                ]); //guardar la compra en el inventario //buscar la existena del producto en la tabla producto
                $existenciapro=Producto::find($productocompra['producto_id']);
                $datosInventario = Inventario::create([
                    'fecha' => date('d-m-Y'),
                    'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
                    'idproducto' => $productocompra['producto_id'],
                    'comprados' => (double)$productocompra['cantidadprorecmat'],
                    'vendidos' => 0,
                    'existencia' => (double)$existenciapro->cantidad
                ]); //actualizar la existencia en la tabla del producto
                $datospro = Producto::find($productocompra['producto_id']);
                $nexistencia = $existenciapro->cantidad+$productocompra['cantidadprorecmat'];
                $datospro->update(['cantidad' => (double)$nexistencia]);
            }
            auditar('COMPRA #: '.$this->compra, 'GUARDAR');
        }
        if($this->idtipopagoventas==2){ /* COMPRA A CREDITO */
            $recepcion = Almacen::find($this->recepcionmaterial_id);
            $datosc = Compra::find($compra);
            $datosc->update([
                'idrecepcion' => $this->recepcionmaterial_id,
                'fecharecepcion' => $recepcion->fecha,
                'fechacompra' => date('d-m-Y'),
                'hora' => date("H:i:s"),
                'idestatuspago' => $this->idestatuspagoventas,
                'idtipopago' => $this->idtipopagoventas,
                'efectivo' => (double)$this->pagoefectivoventas,
                'transferencia' => (double)$this->pagotransfventas,
                'idtipoabonov' => $idtipoabonoven,
                'totalcomra' => (double)session('toprodacum'),
                'totalpagado' =>(double)$this->totalpagoventas,
                'diferenciapago' => (double)$this->restapagoventas,
                'observacionesc' => $this->observacionesc
            ]);
            $recepcion->update(['facturado' => 'SI']);
            foreach ($productosrecepcion as $productocompra){
                $this->i=$this->i+1;
                $datosdc = DetalleComprador::create([
                   'idcompra' => $compra,
                   'idproducto' => $productocompra['producto_id'],
                   'cantidadpro' => $productocompra['cantidadprorecmat'],
                   'operacion' => $productocompra['operacion'],
                   'preciopro' => (double)$this->{"precio".$this->i},
                   'totalpro' => (double)$this->{"toprod".$this->i}
                ]);
                //guardar la compra en el inventario
                //buscar la existena del producto en la tabla producto
                $existenciapro=Producto::find($productocompra['producto_id']);
                $datosInventario = Inventario::create([
                    'fecha' => date('d-m-Y'),
                    'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
                    'idproducto' => $productocompra['producto_id'],
                    'comprados' => (double)$productocompra['cantidadprorecmat'],
                    'vendidos' => 0,
                    'existencia' => (double)$existenciapro->cantidad
                ]);
                //actualizar la existencia en la tabla del producto
                $datospro = Producto::find($productocompra['producto_id']);
                $nexistencia = $existenciapro->cantidad+$productocompra['cantidadprorecmat'];
                $datospro->update(['cantidad' => (double)$nexistencia]);
            } //CREA CUENTA POR PAGAR
            $datos = CuentasPorPagarCompras ::create([
                'idcompra' => $compra,
                'idnegociacionventa' => 0,
                'fecha' => date('d-m-Y'),
                'hora' => date("H:i:s"),
                'cedula' => $this->cedula,
                'montototal' => (double)session('toprodacum'),
                'totalefectivo' => (double)$this->pagoefectivoventas,
                'totaltransferencia' => (double)$this->pagotransfventas,
                'totalpagado' => (double)$this->totalpagoventas,
                /* 'totalresta' => (double)$this->totalrestapagoneg, */
                'totalresta' => (double)$this->restapagoventas,
                'finalizada' => 'NO',
                'amortizando' => '1'
            ]); //CREA EL DETALLE DE LA CUENTA POR PAGAR
            $datosdetalle = DetalleCuentasPorPagarCompras::create([
                'idcppc' => $datos->id,
                'fecha'=> date('d-m-Y'),
                'hora' => date("H:i:s"),
                'efectivo' => (double)$this->pagoefectivoventas,
                'transferencia' => (double)$this->pagotransfventas,
                'pagado' => (double)$this->totalpagoventas,
                'resta' => (double)$this->restapagoventas
            ]);
            auditar('COMPRA - CREDITO #: '.$this->compra, 'GUARDAR');
        }
        $this->mostrar = "false"; $this->mostrarm = "false";
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Compra de Material Realizada!']);
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Se actualizó el Inventário!']);
        $this->reset();
        /* $this->reset(['compra', 'cedula', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'observaciones', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', 'fecharecepcion', 'fechacompra', 'fechacomprau', 'idlugar', 'datalcl', 'idestatuspago', 'idtipopago', 'totalcomra', 'totalpagado', 'diferenciapago', 'idestatuspago', 'idtipopago', 'idestatuspagoc', 'idtipopagoc', 'observacionesc', 'datos', 'state', 'nexistencia', 'diferenciapago', 'totalpagado', 'totalcalculado', 'acumulado']); */
    }
    
    public function default($compra)    {
        $compra = Compra::findOrFail($compra);
        $compra->delete();
        $this->mostrar = "false"; $this->mostrarm = "false";
        auditar('COMPRA #: '.$this->compra, 'CANCELAR');
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Compra de Material Eliminada!']);
        /* $this->limpiar(); */
        $this->reset();
    }

    public function limpiar(){
        $this->reset(['compra', 'cedula', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'state', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', ]);
    }

    /* ABONOS */
    public $pesoabonarv, $mabonar='true', $mostrarabonocompra='false', $mostrarpagoventa='false', $negociacion_idcompra;
    public $pagoefectivonegcompra, $pagotransfnegcompra, $totalfectivonegcompra, $totaltransfnegcompra, $totalpagonegcompra, $totalrestapagonegcompra, $restapagonegcompra, $validamontotncompra, $finalizadac, $ocultarbotoncompra='false', $cedulacompra, $nombrecompra;

    public function nuevoabonocompra(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES
        auditar('COMPRA - ABONO', 'GENERAR ABONO');
        $this->mostrar = "true"; $this->mostrarm = "true"; $this->mostrarabonocompra = "true";
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Abono Generado']);
    }

    public function defaultabonocompra(){
        auditar('COMPRA - ABONO', 'CANCELAR ABONO');
        $this->mostrar = "false"; $this->mostrarm = "false"; $this->mostrarabonocompra = "false";
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Abono Cancelado!']);
        $this->reset();
    }

    public function busproccompra(){ //BUSCA LOS NOMBRES DE LOS PROVEEDORES
        $probccompra=Proveedores::where('cedula',$this->cedulacompra)->get()->pluck('nombre');
        $this->nombrecompra = isset($probccompra) ? $probccompra : "NO EXISTE";
    }

    public function busproncompra(){ //BUSCA LOS PROVEEDORES
        $probncompra=Proveedores::where('nombre',$this->nombrecompra)->get()->pluck('cedula');
        $this->cedulacompra = isset($probncompra) ? $probncompra : "NO EXISTE";
    }

    public function busnegccreditocompra($cedula){ //BUSCA LAS CUENTAS POR COBRAR DE VENTAS $ (negociaciones y creditos) A LOS CLIENTES
        /* $negociacionescredito= CuentasPorCobrarVentas::where('cedula', $cedula) */
        $negociacionescreditocompra= CuentasPorPagarCompras::where('cedula', $cedula)
            ->where('finalizada','NO')->where('totalresta', '<>',0)->get();
        return $negociacionescreditocompra;
    }

    public function calrestaabocredito($restan){ //CALCULA EL RESTO DE LA NEGOCIACION
        if((double)$restan[0]==0){
            $this->validamontotncompra="NO DEBE";
            $this->totalpagonegcompra=0;
            $this->restapagonegcompra=0;
        }elseif(((double)$this->pagoefectivonegcompra+(double)$this->pagotransfnegcompra)>(double)$restan[0]){
                $this->validamontotncompra="TOTAL DEBE SER MENOR O IGUAL A: ".(double)$restan[0];
                $this->totalpagonegcompra=round((double)$this->pagoefectivonegcompra + (double)$this->pagotransfnegcompra,2);
                $this->restapagonegcompra=round((double)$restan[0]-(double)$this->totalpagonegcompra,2);
                $this->ocultarbotoncompra="false";
        }else{
            if((is_numeric((double)$this->pagoefectivonegcompra)) or (is_numeric((double)$this->pagotransfnegcompra))){
                //$idtipopagoneg, $pagoefectivonegcompra, $pagotransfnegcompra, $totalpagonegcompra;
                $this->validamontotncompra="";
                $this->totalpagonegcompra=round((double)$this->pagoefectivonegcompra + (double)$this->pagotransfnegcompra,2);
                $this->restapagonegcompra=round((double)$restan[0]-(double)$this->totalpagonegcompra,2);
                $this->ocultarbotoncompra="true";
            }
        }
        if($this->totalpagonegcompra==0){ $this->ocultarbotoncompra="false"; }
    }

    public function guardaramortizacion(){ //dd($this->negociacion_id);
        $datos = CuentasPorPagarCompras::find($this->negociacion_idcompra);
        $this->totalfectivonegcompra = (double)$datos->totalefectivo+(double)$this->pagoefectivonegcompra;
        $this->totaltransfnegcompra = (double)$datos->totaltransferencia+(double)$this->pagotransfnegcompra;
        $totalpagadocompra=(double)$datos->totalpagado+(double)$this->pagoefectivonegcompra+(double)$this->pagotransfnegcompra;
        $datos->update([
            'totalefectivo' => (double)$this->totalfectivonegcompra,
            'totaltransferencia' => (double)$this->totaltransfnegcompra,
            'totalpagado' => (double)$totalpagadocompra,
            'totalresta' => (double)$this->restapagonegcompra,
            'amortizando' => '1'
        ]); //detalle_cuentas_por_cobrar_ventas 
        $datosdetalle = DetalleCuentasPorPagarCompras::create([
            'idcppc' => $datos->id,
            'fecha'=> date('d-m-Y'),
            'hora' => date("H:i:s"),
            'efectivo' => (double)$this->pagoefectivonegcompra,
            'transferencia' => (double)$this->pagotransfnegcompra,
            'pagado' => (double)$this->pagoefectivonegcompra+(double)$this->pagotransfnegcompra,
            'resta' => (double)$this->restapagonegcompra
        ]); //LA FACTURA SE GENERA DESDE LA BASE DE DATOS CON UN TRIGER $
        /* $this->mostrar = "false"; */ $this->mostrarm = "false"; $this->mostrarpagoneg = 'false';
        if($datos->idventa==0){ auditar('COMPRA - NEGOCIACION #: '.$datos->idnegociacionventa, 'ABONO A CREDITO');
        }else{ auditar('COMPRA - CREDITO #: '.$datos->idventa, 'AMORTIZACION A CREDITO'); }
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Negociación Actualizada! '.$datos->idnegociacionventa]);
        $this->reset(['totalfectivonegcompra', 'totaltransfnegcompra', 'restapagonegcompra', 'pagoefectivonegcompra', 'pagotransfnegcompra']);
    }

    /* FIN ABONOS */

    public function show(){
        $compras = Compra::all();
        return view('livewire.purchases.show', compact('compras'));
    }

    public function render()
    {
        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $recepcion = Almacen::all()->where('recibido', 'NO');
        /* $recepcionescompras=Almacen::all()->where('facturado', 'NO'); */
        /* $recepcionescompras=DB::table('recepcionmaterial')
            ->join('proveedores', 'recepcionmaterial.cedula', '=', 'proveedores.cedula')
            ->where('recepcionmaterial.facturado', 'NO')->get(); */
        $recepcionescompras=ConsultaTraerRecepcionComprar::all();
        //dd($recepcionescompras);
        $materiales = Material::all();

        $recibir=Almacen::all()->where('facturado', 'NO');

        $este=$this->recepcion;
        $productosrecepcion=Detallealmacen::all()->where('recepcionmaterial_id', 
        $this->recepcionmaterial_id);
        $this->efectivodisc = Liquidez::where('id', 1)->get()->pluck('efectivo')[0];
        $this->bancodisc = Liquidez::where('id', 1)->get()->pluck('banco')[0];
        $amortizacionesdepagocompra=ConsultaAmortizacionNegociacionCompra ::all();

        return view('livewire.comprador-component', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion', 'recepcionescompras', 'amortizacionesdepagocompra', 'recibir'));
    }
}