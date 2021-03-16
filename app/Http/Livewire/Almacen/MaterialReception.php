<?php

namespace App\Http\Livewire\Almacen;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\Material;

use App\Models\almacen;
use App\Models\Detallealmacen;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Http\Livewire\Almacen\Request;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Cache;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class MaterialReception extends Component
{
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

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    protected $validationattributs = [
        'cantidadprorecmat' => 'Cantidad',
    ];

    protected $messages = [
        'cantidadprorecmat.required' => 'Por favor ingrese la Cantidad.',
        'cantidadprorecmat.max' => 'La Cantidad no puede tener más 8 cífras.',
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
            /* 'recepcionmaterial_id' => 'required', */
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
            if($this->pesofull>0 or $this->pesovacio>0){
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
    
    public function verificarpeso(){ //CALCULA EL PESO DISPONIBLE
        if($this->pesodisponiblec > $this->state['cantidadprorecmat']){
            $this->pesodisponiblec = $this->pesodisponible - (double)$this->state['cantidadprorecmat'];
            $this->acumuladoc = $this->acumulado + (double)$this->state['cantidadprorecmat'];
        }else{ 
            $this->pesodisponiblec=(string)$this->pesodisponible." INSUFICIENTE";
            $this->acumuladoc = $this->acumulado; }
    }

    public function busproc(){ //BUSCA LOS PROVEEDORES
        $probc=Proveedores::where('cedula',$this->cedula)->get()->pluck('nombre');
        $this->nombre = isset($probc) ? $probc : "NO EXISTE";
    }

    public function buspron(){ //BUSCA LOS PROVEEDORES
        $probn=Proveedores::where('nombre',$this->nombre)->get()->pluck('cedula');
        $this->cedula = isset($probn) ? $probn : "NO EXISTE";
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
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Recepción de Material Generada']);
    }

    public function update($recepcionmaterial_id)    {
        //$this->validate();
        /* $productosrecepcion=Detallealmacen::find($recepcionmaterial_id); */
        //dd($productosrecepcion);
        /* if(isNull($productosrecepcion)){ */
            /* dd("ENTRO IF"); */
            $nopuedeguardar="Debe agregar materiales que sumen la cantidad del PESO NETO";
        /* }else{ */
            /* dd("ENTRO ELSE"); */
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
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Recepción de Material Actualizada!']);
            $this->reset(['cedula', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 
                      'almacen_id', 'producto_id', 'cantidadprorecmat', 'observaciones', 'recepcionmaterial_id', 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc']);
        /* } */
    }
    
    public function default($recepcionmaterial_id)    {
        //dd($recepcionmaterial_id);
        $user = Almacen::findOrFail($recepcionmaterial_id);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Recepción de Material Eliminada!']);
        $this->reset(['cedula', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 
                      'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc']);
    }

    public function render()
    {
            $vendedores = Proveedores::all();
            $lugares = Sucursal::all();
            $productos = Producto::all();
            $recepcion = Almacen::latest('id')->first(); //AQUÍ SE COLOCA EL ID DEL ALMACEN
            $materiales = Material::all();
            $este=$this->recepcion;
            $productosrecepcion=Detallealmacen::all()->where('recepcionmaterial_id', $this->recepcionmaterial_id);
            return view('livewire.almacen.material-reception', [
                        'materiales'=>$materiales,
                ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion'));
    }
}
