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

class MaterialReception extends Component
{
    public $fecha, $cedula, $nombre, $idlugar, $pesofull, $pesovacio, $pesoneto, $observaciones, $almacen_id;
    public $recepcion, $recepcionmaterial_id, $producto_id, $cantidadprorecmat, $operacion, $detalmacen_id;
    public $accion = "store";
    public $acciones = "stores";
    public $productosr;
    public $pesocalculado = 0;
    public $acumulado = 0;
    public $numcierre;
    public $accionrecmat;

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
            /* 'recepcionmaterial_id' => 'required', */
            'producto_id' => 'required',
            'cantidadprorecmat' => 'required|max:8',
            'operacion' => 'max:10'
        ])->validate();
        Material::create($validateData);
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

    public function calpeso(){
        $this->pesoneto=$this->pesofull-$this->pesovacio;
    }
    
    public function buspro(){

    }

    public function guardar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES
        $fecha=date('d-m-Y');
        $datos = Almacen::create([
            'fecha' => $this->fecha,
            'cedula' => $this->cedula,
            'idlugar' => $this->idlugar,
            'pesofull' => $this->pesofull,
            'pesovacio' => $this->pesovacio,
            'pesoneto' => $this->pesoneto,
            'pesocalculado' => $this->pesoneto,
            'observaciones' => $this->observaciones
        ]);
        $accionrecmat="confirmar";
        $recepcion = Almacen::latest('id')->first();
        //$recepcion=$recepcion->id;
        $this->recepcionmaterial_id=$recepcion->id;
        //dd($this->recepcionmaterial_id);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Datos Guardados correctamente!']);
    }

    public function render()
    {
        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $recepcion = Almacen::latest('id')->first();
        $productosrecepcion=Detallealmacen::all();
        $materiales = Material::all();
        $este=$this->recepcion;
        //$this->recepcionmaterial_id=$recepcion->id;
        return view('livewire.almacen.material-reception', [
            'materiales'=>$materiales,
        ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion'));
    }

}
