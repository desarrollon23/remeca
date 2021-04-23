<?php

namespace App\Http\Livewire\Almacen;

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
//use App\Http\Livewire\Almacen\Request;
use Illuminate\Http\Request;
use Hamcrest\Type\IsNumeric;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MaterialReception extends Component{

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
    public $editm_id, $traesuma='NO', $mostrar = "false", $mostrarm = "false";

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    protected $rules = [
        'cedula' => 'required|max:15',
        'nombre' => 'required|max:50',
        'idlugar' => 'required',
        'pesofull' => 'required',
        'pesovacio' => 'required',
        'pesoneto' => 'required',
        'pesocalculado' => 'required',
        'observaciones' => 'max:250',
        'state.producto_id' => 'required',
        'state.cantidadprorecmat' => 'required',
        'state.operacion' => 'required|max:10',
    ];

    protected $validationattributs = [
        'cedula' => 'Cédula',
        'nombre' => 'Nombre',
        'idlugar' => 'Lugar',
        'pesofull' => 'Peso FULL',
        'pesovacio' => 'Peso VACIO',
        'pesoneto' => 'Peso NETO',
        'observaciones.max' => 'Observaciones',
        'state.producto_id' => 'MATERIAL',
        'state.cantidadprorecmat' => 'PESO',
        'state.operacion' => 'OPERACION'
    ];

    protected $messages = [
        'cedula.required' => 'Ingrese la Cédula',
        'cedula.max' => 'Máximo 15 caracteres',
        'nombre.required' => 'Ingrese el Nombre',
        'nombre.max' => 'Máximo 50 caracteres',
        'idlugar.required' => 'Seleccione el Lugar',
        'pesofull.required' => 'Ingrese el Peso FULL',
        'pesofull.max' => 'Máximo 8 cifras',
        'pesovacio.required' => 'Ingrese el Peso VACIO',
        'pesovacio.max' => 'Máximo 8 cifras',
        'pesoneto.required' => 'Ingrese el Peso NETO',
        'pesoneto.max' => 'Máximo 8 cifras',
        'observaciones.max' => 'Máximo 250 caracteres',
        'state.producto_id.required' => 'SELECCIONE',
        'state.cantidadprorecmat.required' => 'INGRESE',
        'state.cantidadprorecmat.max' => 'MAXIMO 8 CIFRAS',
        'state.operacion.required' => 'SELECCIONE'
    ];

    public function storem()    {
        $this->validate();
        Material::create([
            'recepcionmaterial_id' => $this->recepcionmaterial_id,
            'producto_id' => $this->state['producto_id'],
            'cantidadprorecmat' => $this->state['cantidadprorecmat'],
            'operacion' => $this->state['operacion']
        ]);
        session(['pt' => (double)session('pt')+(double)$this->state['cantidadprorecmat']]);
        session(['pf' => (double)session('pf')-(double)$this->state['cantidadprorecmat']]);
        if(session('pf') == 0){ $this->mostrarm="false"; }
        else{ $this->reset(['state', 'producto_id', 'cantidadprorecmat', 'operacion']); }
        /* auditar('RECEPCION DE MATERIAL #: '.$this->recepcionmaterial_id, 'AGREGAR MATERIAL'); */
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material agregado correctamente!']);
    }

    public function destroy(Material $material){
        (double)$this->pmm=$material->cantidadprorecmat;
        $material->delete();
        session(['pt' => (double)session('pt')-(double)$this->pmm]);
        session(['pf' => (double)session('pf')+(double)$this->pmm]);
        if(session('pf') > 0){ $this->mostrarm="true"; }
        /* auditar('RECEPCION DE MATERIAL #: '.$this->recepcionmaterial_id, 'ELIMINAR MATERIAL'); */
        $this->reset(['producto_id', 'cantidadprorecmat', 'operacion', 'editm_id', 'pmm']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado!']);
    }

    public function calpeso(){ //CALCULA EL PESO NETO
        if((!is_null($this->pesofull)) and (!is_null($this->pesovacio))){
            if($this->pesofull>=1 and $this->pesovacio>=1){
                if($this->pesofull>$this->pesovacio){
                    $this->pesoneto=$this->pesofull - $this->pesovacio;
                    session(['pf' => $this->pesoneto]);
                    if(session('pf') > 0){ $this->mostrarm="true"; }
                }else{ $this->pesoneto="PESO FULL <= PESO VACIO"; }
            }
        }
        if(is_null($this->pesofull)){ $this->pesoneto="Ingrese PESO FULL"; }
        if(is_null($this->pesovacio)){ $this->pesoneto="Ingrese PESO VACIO"; }
    }
    
    public function verificarpeso(){ //CALCULA EL PESO DISPONIBLE
        if(session('pf') >= $this->state['cantidadprorecmat']){
            $this->pesoi="";
        }else{ 
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

    public $nrm;
    public function generar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES       
        /* $nrm = Almacen::count(); 
        if($nrm==0){ $nrm = 1; }else{ ++$nrm; } */
        $nr = Almacen::latest('id')->first();
        //dd(is_null($nr));
        if(is_null($nr)=="true" or $nr['id']==0){ $nrm = 1; }else{ $nrm=$nr['id']+1; }
        $datos = Almacen::create([
            'id' => $nrm,           
            'fecha' => $this->fecha,
            'cedula' => $this->cedula,
            'idlugar' => $this->idlugar,
            'pesofull' => $this->pesofull,
            'pesovacio' => $this->pesovacio,
            'pesoneto' => $this->pesoneto,
            'pesocalculado' => $this->pesoneto,
            'observaciones' => $this->observaciones,
            'recibido' => 'NO',
            'facturado' => 'NO'
        ]);
        $this->mostrar = "true"; $this->mostrarm = "true";
        $recepcion = Almacen::latest('id')->first();
        $this->recepcionmaterial_id=$recepcion->id;
        session(['pt' => 0]); session(['pf' => 0]);
        auditar('RECEPCION DE MATERIAL #: '.$this->recepcionmaterial_id, 'GENERAR');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Recepción de Material Generada']);
    }

    public function update($recepcionmaterial_id){
        $this->validate();
        if(session('pf') > (double)0){
            $this->dispatchBrowserEvent('no-existe', ['message' => 'Faltan '.session('pf').'KG por registrar']);
        }elseif(session('pf') == (double)0){
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
                'observaciones' => $this->observaciones,
                'recibido' => 'SI',
                'facturado' => 'NO'
            ]);
            /* auditar('RECEPCION DE MATERIAL #: '.$this->recepcionmaterial_id, 'GUARDAR'); */
            $this->vpeso = "true";
            $this->mostrar = "false"; $this->mostrarm = "false";
            $this->emitTo('principal', 'render');
            session(['pt' => 0]); session(['pf' => 0]); session(['vpeso' => false]);
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Recepción de Material Actualizada!']);
            $this->reset(['cedula', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat', 'observaciones', 'recepcionmaterial_id', 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', 'state', 'messages']);
        }
    }
    
    public function default($recepcionmaterial_id)    {
        $nc = Material::where('recepcionmaterial_id',$recepcionmaterial_id)->get()->count();
        if($nc>0){ 
            $this->dispatchBrowserEvent('no-existe', ['message' => 'Elimine los Materiales para poder Cancelar la Recepción']);
        }else{
            $user = Almacen::findOrFail($recepcionmaterial_id);
            $user->delete();
            session(['pt' => 0]); session(['pf' => 0]);
            /* auditar('RECEPCION DE MATERIAL #: '.$this->recepcionmaterial_id, 'CANCELAR'); */
            $this->vpeso = "false";
            $this->mostrar = "false"; $this->mostrarm = "false";
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Recepción de Material  Eliminada!']);
            $this->reset(['cedula', 'idlugar', 'nombre', 'pesofull', 'pesovacio', 'pesoneto',   'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id",    'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', 'state', 'cantidadprorecmat',  'pesoi', 'messages']);
        }
    }
    
    public function render(){
        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $recepcion = Almacen::latest('id')->first(); //AQUÍ SE COLOCA EL ID DEL ALMACEN
        $materiales = Material::all();
        $este=$this->recepcion;                                    
        $productosrecepcion=Detallealmacen::all()->where('recepcionmaterial_id',$this->recepcionmaterial_id);
        $traesuma=Detallealmacen::where('recepcionmaterial_id',$this->recepcionmaterial_id)
                                    ->where('operacion','SUMA')->get();
        return view('livewire.almacen.material-reception', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion', 'traesuma'));
    }
}
