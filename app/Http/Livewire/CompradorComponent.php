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

    public function calpreind($numero, $cantpro){
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

    public function busnumal(){ //BUSCA LOS DATOS DEL ALMACEN
        $nc = Almacen::count();
        if($nc>0){ 
            if($this->recepcionmaterial_id>$nc){ 
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

    public function generar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES       
        if(!is_null($this->recepcionmaterial_id)){
        $nc = Compra::count();
        if($nc==0){ $nc = 1; }else{ ++$nc; }
        $recepcion = Almacen::find($this->recepcionmaterial_id);
        $datosc = Compra::create([
            'id' => $nc,           
            'idrecepcion' => $this->recepcionmaterial_id,
            'fecharecepcion' => $recepcion->fecha,
            'fechacompra' => $this->fechacompra,
            'hora' => $this->hora,
            'cedula' => $recepcion->cedula,
            'idlugar' => $recepcion->idlugar,
            'idestatuspago' => 1,
            'idtipopago' => 1,
            'totalcomra' => 0,
            'totalpagado' => 0,
            'diferenciapago' => 0,
            'observacionesc' => 'NINGUNA'
        ]);
        $compra = Compra::latest('id')->first();
        $this->compra=$compra->id;
        $this->mostrar = "true"; $this->mostrarm = "true";
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Compra de Material Generada']);
        }else{
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Ingrese el número de Almacen ']);
            $this->datalm=""; $this->limpiar();
        }
    }

    public function update($compra, $productosrecepcion, $totalcalculado){
        $this->validate();
        $this->fechacomprau = date('d-m-Y');
        $recepcion = Almacen::find($this->recepcionmaterial_id);
        $datosc = Compra::find($compra);
        $datosc->update([
            'idrecepcion' => $this->recepcionmaterial_id,
            'fecharecepcion' => $recepcion->fecha,
            'fechacompra' => $this->fechacomprau,
            'hora' => date("H:i:s"),
            'cedula' => $recepcion->cedula,
            'idlugar' => $recepcion->idlugar,
            'idestatuspago' => $this->state['idestatuspago'],
            'idtipopago' => $this->state['idtipopago'],
            'totalcomra' => (double)$totalcalculado,
            'totalpagado' =>(double)$this->state['totalpagado'],
            'diferenciapago' => (double)$this->state['diferenciapago'],
            'observacionesc' => $this->state['observacionesc']
        ]);
        $recepcion->update([
           'facturado' => 'SI'
        ]);
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
                'fecha' => $this->fechacomprau,
                'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
                'idproducto' => $productocompra['producto_id'],
                'comprados' => (double)$productocompra['cantidadprorecmat'],
                'vendidos' => 0,
                'existencia' => (double)$existenciapro->cantidad
            ]);
            //actualizar la existencia en la tabla del producto
            $datospro = Producto::find($productocompra['producto_id']);
            $nexistencia = $existenciapro->cantidad+$productocompra['cantidadprorecmat'];
            $datospro->update([
                'cantidad' => (double)$nexistencia
            ]);
        }
        $this->mostrar = "false"; $this->mostrarm = "false";
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Compra de Material Realizada!']);
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Se actualizó el Inventário!']);
        $this->reset(['compra', 'cedula', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'observaciones', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', 'fecharecepcion', 'fechacompra', 'fechacomprau', 'idlugar', 'datalcl', 'idestatuspago', 'idtipopago', 'totalcomra', 'totalpagado', 'diferenciapago', 'idestatuspago', 'idtipopago', 'idestatuspagoc', 'idtipopagoc', 'observacionesc', 'datos', 'state', 'nexistencia', 'diferenciapago', 'totalpagado', 'totalcalculado', 'acumulado']);
    }
    
    public function default($compra)    {
        $compra = Compra::findOrFail($compra);
        $compra->delete();
        $this->mostrar = "false"; $this->mostrarm = "false";
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Compra de Material Eliminada!']);
        $this->limpiar();
    }

    public function limpiar(){
        $this->reset(['compra', 'cedula', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'state', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', ]);
    }

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
        $recepciones = Almacen::all()->where('facturado', 'NO');
        dd($recepciones->count());
        $materiales = Material::all();
        $este=$this->recepcion;
        $productosrecepcion=Detallealmacen::all()->where('recepcionmaterial_id', 
        $this->recepcionmaterial_id);
        return view('livewire.comprador-component', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion', 'recepciones'));
    }
}