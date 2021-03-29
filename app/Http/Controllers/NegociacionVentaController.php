<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use App\Models\Material;
use App\Models\almacen;
use App\Models\Detallealmacen;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
//use Illuminate\Http\Request;
use Hamcrest\Type\IsNumeric;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class NegociacionVentaController extends Controller
{
    /* public function __construct() //PROTEGE LAS RUTAS PARA QUE NO LA ABRA UN USUARIO SI NO TIENE PERMISO
    {
        $this->middleware('can:livewire.almacen.material-reception.index')->only('index');
        $this->middleware('can:livewire.almacen.material-reception.create')->only('create', 'store');
        $this->middleware('can:livewire.almacen.material-reception.edit')->only('edit', 'update');
        $this->middleware('can:livewire.almacen.material-reception.destroy')->only('destroy');
    } */
    public $fecha, $cedula, $nombre, $idlugar, $pesofull, $pesovacio, $pesoneto, $observaciones, $almacen_id;
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
    public $editm_id, $traesuma='NO';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    protected $rules = [
        'cedula' => 'required',
        'idlugar' => 'required',
        'pesofull' => 'required',
        'pesovacio' => 'required',
        'pesoneto' => 'required',
        'pesocalculado' => 'required',
        'producto_id' => 'required',
        'cantidadprorecmat' => 'required'
    ];

    protected $validationattributs = [
        'cedula' => 'Cédula',
        'idlugar' => 'Lugar',
        'pesofull' => 'Peso FULL',
        'pesovacio' => 'Peso VACIO',
        'pesoneto' => 'Peso NETO',
        'producto_id' => 'Material', 
        'cantidadprorecmat' => 'Cantidad de Material',
        'cantidadprorecmat' => 'Cantidad'
    ];

    protected $messages = [
        'cedula.required' => 'Por favor ingrese la Cédula.',
        'cedula.max' => 'La Cédula no puede tener más de 12 caracteres.',
        'idlugar.required' => 'Por favor Seleccione el Lugar.',
        'pesofull.required' => 'Por favor ingrese el Peso FULL.',
        'pesofull.max' => 'El Peso FULL no puede tener más de 8 cifras.',
        'pesovacio.required' => 'Por favor ingrese el Peso VACIO.',
        'pesovacio.max' => 'El Peso VACIO no puede tener más de 8 cifras.',
        'pesoneto.required' => 'Por favor ingrese el Peso NETO.',
        'pesoneto.max' => 'El Peso NETO no puede tener más de 8 cifras.',
        'observaciones.max' => 'Las Observaciones no pueden tener más de 250 caracteres.',
        'cantidadprorecmat.required' => 'Por favor ingrese la Cantidad de Material.',
        'cantidadprorecmat.max' => 'La Cédula no puede tener más de 8 cifras.'
    ];


    public function addNew(){
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser(){
        $validateData = Validator::make($this->state, [
            'producto_id' => 'required',
            'cantidadprorecmat' => 'required|max:8',
            'operacion' => 'max:10'
        ])->validate();
        Material::create([
            'recepcionmaterial_id' => $this->recepcionmaterial_id,
            'producto_id' => $this->state['producto_id'],
            'cantidadprorecmat' => $this->state['cantidadprorecmat'],
            'operacion' => $this->state['operacion']
        ]);
            (double)$this->ptg=(double)session('pt')+(double)$this->state['cantidadprorecmat'];
            (double)$this->pfg=(double)session('pf')-(double)$this->state['cantidadprorecmat'];
            session(['pt' => $this->ptg]);
            session(['pf' => $this->pfg]);
        $this->reset(['state', 'producto_id', 'cantidadprorecmat', 'operacion']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material agregado correctamente!']);
    }
    public function storem()    {
        $validateData = Validator::make($this->state, [
            'producto_id' => 'required',
            'cantidadprorecmat' => 'required|max:8',
            'operacion' => 'max:10'
        ])->validate();
        Material::create([
            'recepcionmaterial_id' => $this->recepcionmaterial_id,
            'producto_id' => $this->state['producto_id'],
            'cantidadprorecmat' => $this->state['cantidadprorecmat'],
            'operacion' => $this->state['operacion']
        ]);
        /* (double)$this->ptg=(double)session('pt')+(double)$this->state['cantidadprorecmat'];
        (double)$this->pfg=(double)session('pf')-(double)$this->state['cantidadprorecmat']; */
        session(['pt' => (double)session('pt')+(double)$this->state['cantidadprorecmat']]);
        session(['pf' => (double)session('pf')-(double)$this->state['cantidadprorecmat']]);
        if(!isnull(session('pt'))==!isnull($this->pesoneto)){
            $this->vpeso = "true";
        }
        $this->reset(['state', 'producto_id', 'cantidadprorecmat', 'operacion']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material agregado correctamente!']);
    }

    public function edit($id){
        $Detallealmacen=Material::find($id);
        $this->editm_id = $Detallealmacen->id;
        $this->state['producto_id'] = $Detallealmacen->producto_id;
        $this->state['cantidadprorecmat'] = $Detallealmacen->cantidadprorecmat;
        $this->state['operacion'] = $Detallealmacen->operacion;
        /* session(['editm_id' => $Detallealmacen->id]); */
        $this->accion = "update";
        (double)$this->pmm=$this->state['cantidadprorecmat'];
        session(['pt' => (double)session('pt')-(double)$this->pmm]);
        session(['pf' => (double)session('pf')+(double)$this->pmm]);
    }
    
    public function updatematerial(){
        (double)$this->pmm=(double)$this->state['cantidadprorecmat'];
        $material = Material::find($this->editm_id);
        $material->update([
            'producto_id' => $this->state['producto_id'],
            'cantidadprorecmat' => $this->state['cantidadprorecmat'],
            'operacion' => $this->state['operacion']
        ]);
        session(['pt' => (double)session('pt')+(double)$this->pmm]);
        session(['pf' => (double)session('pf')-(double)$this->pmm]);
        $this->accion = "store";
        $this->reset(['producto_id', 'cantidadprorecmat', 'operacion', 'editm_id', 'pmm']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material actualizado correctamente!']);
        //dd($Detallealmacen);
    }

    public function destroy(Material $material){
        (double)$this->pmm=$material->cantidadprorecmat;
        $material->delete();
        session(['pt' => (double)session('pt')-(double)$this->pmm]);
        session(['pf' => (double)session('pf')+(double)$this->pmm]);
        //$this->accion = "store";
        if(session('pt')<$this->pesoneto){
            $this->vpeso = "false";
        }
        $this->reset(['producto_id', 'cantidadprorecmat', 'operacion', 'editm_id', 'pmm']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado!']);
    }

    /* public function updateUser(){
        $validateData = Validator::make($this->state, [
            // 'recepcionmaterial_id' => 'required',
            'producto_id' => 'required',
            'cantidadprorecmat' => 'required|max:8',
        ])->validate();
        $this->user->update($validateData);
        
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material actualizado correctamente!']);
    } */

    /* public function confirmUserRemoval($userId){
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    } */

    public function deleteUser(){
        $user = Material::findOrFail($this->userIdBeingRemoved);
        (double)$this->state['cantidadprorecmat']=(double)$user->$this->cantidadprorecmat;
        $user->delete();
        /* if($this->state['operacion']=="RESTA"){ */
            (double)$this->pag=(double)session('pt')-(double)$this->state['cantidadprorecmat'];
            (double)$this->pag=(double)session('pf')+(double)$this->state['cantidadprorecmat'];
            session(['pt' => $this->pag]);
            session(['pf' => $this->pag]);
        /* } */
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Material Eliminado!']);
    }

    public function calpeso(){ //CALCULA EL PESO NETO
        if((!is_null($this->pesofull)) and (!is_null($this->pesovacio))){
            if($this->pesofull>=1 and $this->pesovacio>=1){
                if($this->pesofull>$this->pesovacio){
                    $this->pesoneto=$this->pesofull - $this->pesovacio;
                    session(['pf' => $this->pesoneto]);
                }else{ $this->pesoneto="PESO FULL <= PESO VACIO"; }
            }
        }
        if(is_null($this->pesofull)){ $this->pesoneto="Ingrese PESO FULL"; }
        if(is_null($this->pesovacio)){ $this->pesoneto="Ingrese PESO VACIO"; }
    }
    
    public function verificarpeso(){ //CALCULA EL PESO DISPONIBLE
        if(session('pf') >= $this->state['cantidadprorecmat']){
            $this->vpeso = "false";
            $this->pesoi="";
        }else{ 
            $this->vpeso = "true";
            $this->pesoi="PESO INSUFICIENTE INGRESE UNA CANTIDAD MENOR";
        }       
    }

    public function busproc(){ //BUSCA LOS PROVEEDORES
        $probc=Proveedores::where('cedula',$this->cedula)->get()->pluck('nombre');
        $this->nombre = isset($probc) ? $probc : "NO EXISTE";
    }

    public function buspron(){ //BUSCA LOS PROVEEDORES
        $probn=Proveedores::where('nombre',$this->nombre)->get()->pluck('cedula');
        $this->cedula = isset($probn) ? $probn : "NO EXISTE";
    }

    public function traedesmaterial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['descripcion'];
        return $this->muesdesmaterial;
    }

    public function generar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES       
        $nrm = Almacen::count();       
        if($nrm==0){ $nrm = 1; }else{ ++$nrm; }       
        $datos = Almacen::create([
            'id' => $nrm,           
            'fecha' => $this->fecha,
            'cedula' => $this->cedula,
            'idlugar' => $this->idlugar,
            'pesofull' => $this->pesofull,
            'pesovacio' => $this->pesovacio,
            'pesoneto' => $this->pesoneto,
            'pesocalculado' => $this->pesoneto,
            'observaciones' => $this->observaciones
        ]);
        $recepcion = Almacen::latest('id')->first();
        $this->recepcionmaterial_id=$recepcion->id;
        session(['pt' => 0]); session(['pf' => 0]);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Recepción de Material Generada']);
    }

    public function update($recepcionmaterial_id)    {
        /* $traesuma=Detallealmacen::where('recepcionmaterial_id',$recepcionmaterial_id)->get()->pluck('operacion'); */
        //$traesuma=Detallealmacen::where('recepcionmaterial_id',159)->get()->pluck('operacion');
        /* $this->nopuedeguardar = isset($traesuma) ? $traesuma : "NO";
        dd($this->nopuedeguardar);
        if($this->nopuedeguardar=="NO"){
            $this->vpeso = "true";
            $this->nopuedeguardar="Debe agregar materiales que sumen la cantidad del PESO NETO";
        }else{ */
        $this->fecha = date('d-m-Y');
        $datos = Almacen::find($recepcionmaterial_id);
        $datos->update([
            'fecha' => $this->fecha,
            'cedula' => $this->cedula,
            'idlugar' => $this->idlugar,
            'pesofull' => $this->pesofull,
            'pesovacio' => $this->pesovacio,
            'pesoneto' => $this->pesoneto,
            'pesocalculado' => $this->pesoneto,
            'observaciones' => $this->observaciones
        ]);
        session(['pt' => 0]); session(['pf' => 0]);
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Recepción de Material Actualizada!']);
        $this->reset(['cedula', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 
                  'almacen_id', 'producto_id', 'cantidadprorecmat', 'observaciones', 'recepcionmaterial_id', 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', 'state']);
        /* } */
    }
    
    public function default($recepcionmaterial_id)    {
        /* $user = Detallealmacen::all()->where('recepcionmaterial_id', $this->recepcionmaterial_id);
        $user->delete(); */
        $user = Almacen::findOrFail($recepcionmaterial_id);
        $user->delete();
        session(['pt' => 0]); session(['pf' => 0]);
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Recepción de Material Eliminada!']);
        $this->reset(['cedula', 'idlugar', 'nombre', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', 'state', 'cantidadprorecmat']);
    }
    
    public function render()
    {
        //$recepcionmaterial_id=10;
//        dd($this->recepcionmaterial_id);
        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $recepcion = Almacen::latest('id')->first(); //AQUÍ SE COLOCA EL ID DEL ALMACEN
        $materiales = Material::all();
        $este=$this->recepcion;                                    
        $productosrecepcion=Detallealmacen::all()->where('recepcionmaterial_id',$this->recepcionmaterial_id);

        $traesuma=Detallealmacen::where('recepcionmaterial_id',$this->recepcionmaterial_id)
                                    ->where('operacion','SUMA')->get();

        //dd($traesuma);
        /* return view('livewire.almacen.material-reception', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion', 'traesuma')); */
        return view('livewire.ventas.index');
    }
}
