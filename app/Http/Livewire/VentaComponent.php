<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Material;
use App\Models\almacen;
use App\Models\Cliente;
use App\Models\Detallealmacen;
use App\Models\DetalleNegociacionVenta;
use App\Models\NegociacionVenta;
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

class VentaComponent extends Component
{
    /* public function __construct() //PROTEGE LAS RUTAS PARA QUE NO LA ABRA UN USUARIO SI NO TIENE PERMISO
    {
        $this->middleware('can:livewire.almacen.material-reception.index')->only('index');
        $this->middleware('can:livewire.almacen.material-reception.create')->only('create', 'store');
        $this->middleware('can:livewire.almacen.material-reception.edit')->only('edit', 'update');
        $this->middleware('can:livewire.almacen.material-reception.destroy')->only('destroy');
    } */
    public $fechaventa, $cedulav, $nombre, $idlugarv, $idestatuspagov, $idtipopagov, $placav, $observacionesv, $idventa, $idproductov, $cantidadprov, $precioprov;
    public $venta, $mostrar='false', $mostrarm='false'; 

    public $horaventa, $pesofullv, $pesovaciov, $pesonetov, $pesocalculadov, $totalcomrav, $totalpagadov, $diferenciapagov, $ajusteporpesov;

    public $fecha, $idlugar, $pesofull, $pesovacio, $pesoneto, $observaciones, $almacen_id;
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
        'cedulav' => 'required|max:15',
        'nombre' => 'required|max:50',
        'idlugarv' => 'required', 
        'idestatuspagov' => 'required',
        'idtipopagov' => 'required',
        'placav' => 'required',
        'observacionesv' => 'required|max:250',
        'idproductov' => 'required',
        'cantidadprov' => 'required|max:8',
        'precioprov' => 'required|max:8',
    ];

    protected $validationattributs = [
        'cedulav' => 'Cédula',
        'nombre' => 'Nombre',
        'idlugarv' => 'Lugar',
        'idestatuspagov' => 'Estatus de Pago',
        'idtipopagov' => 'Tipo de Pago',
        'placav' => 'Placa Camión',
        'observacionesv' => 'Observaciones',
        'idproductov' => 'MATERIAL',
        'cantidadprov' => 'CANTIDAD',
        'precioprov' => 'PRECIO',
    ];

    protected $messages = [
        'cedulav' => 'Ingrese Cédula',
        'nombre' => 'Ingrese Nombre',
        'idlugarv' => 'Seleccione', 
        'idestatuspagov' => 'Seleccione',
        'idtipopagov' => 'Seleccione',
        'observacionesv' => 'Ingrese Observaciones',
        'idproductov' => 'SELECCIONE',
        'cantidadprov' => 'INGRESE',
        'precioprov' => 'INGRESE',
    ];

    public function storem(){
        //$this->validate();
        $existencia=Producto::find($this->idproductov);
        $this->muesdesmaterial=$existencia['cantidad'];
        //dd($this->muesdesmaterial);
        if($this->muesdesmaterial<$this->cantidadprov){
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'No puede agregar esa cantidad, actualmente tiene '.$this->muesdesmaterial.' KG disponible(s)']);
        }else{
            DetalleVenta::create([
                'idventa' => $this->recepcionmaterial_id,
                'idproductov' => $this->idproductov,
                'cantidadprov' => (double)$this->cantidadprov,
                'precioprov' => (double)$this->precioprov,
                'totalprov' => (double)$this->totalprov
            ]);
            //session(['tpn' => (double)session('tpn')+(double)$this->totalpronegn]);
            $this->reset([/* 'negociacion_id', 'producto_idn', 'cantidadprorecmatn', 'precionegn', */ 'totalpronegn']);
            $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material agregado correctamente!']);
        }
    }

    public function destroy(DetalleVenta $detalleventa){
        (double)$this->pmmdn=$detalleventa->totalpronegn;
        $detalleventa->delete();
        $this->reset(['idproductov', 'cantidadprov', 'precioprov', 'totalprov']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado!']);
    }

    public function calpeso(){ //CALCULA EL PESO NETO
        //if((is_numeric($this->cantidadprov)) and (is_numeric($this->precioprov))){
            $this->totalprov=$this->cantidadprov * $this->precioprov;
            //session(['totalcalculado' => $this->totalcalculado+$this->totalprov]);
        //}
    }

    public function busproc(){ //BUSCA LOS PROVEEDORES
        $probc=Cliente::where('cedulac',$this->cedulav)->get()->pluck('nombrec');
        $this->nombre = isset($probc) ? $probc : "NO EXISTE";
    }

    public function buspron(){ //BUSCA LOS PROVEEDORES
        $probn=Cliente::where('nombrec',$this->nombre)->get()->pluck('cedulac');
        $this->cedula = isset($probn) ? $probn : "NO EXISTE";
    }

    public function traedesmaterial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['descripcion'];
        return $this->muesdesmaterial;
    }

    public function generar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES       
        $nrm = Venta::count();       
        if($nrm==0){ $nrm = 1; }else{ ++$nrm; }       
        $datos = Venta::create([
            'id' => $nrm,           
            'fechanventa' => $this->fecha,
            'cedulav' => $this->cedulav,
            'idlugarv' => $this->idlugarv,
            'idestatuspagov' => $this->idestatuspagov,
            'idtipopagov' => $this->idtipopagov,
            'placav' => $this->placav,
            'observacionesv' => $this->observacionesv
        ]);
        $this->mostrar = "true"; $this->mostrarm = "true";
        $recepcion = NegociacionVenta::latest('id')->first();
        $this->recepcionmaterial_id=$recepcion->id;
        /* session(['ptn' => 0]); session(['pfn' => 0]); */
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Negociación Generada']);
    }
    public function update($recepcionmaterial_id)    {
        $this->validate();
    }
    public function default($recepcionmaterial_id)    {
        $nc = DetalleVenta::where('idventa',$recepcionmaterial_id)->get()->count();
        if($nc>0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Elimine los Materiales para poder Cancelar la Negociación']);
        }else{
            $user = Venta::findOrFail($recepcionmaterial_id);
            $user->delete();
            /* session(['ptn' => 0]); session(['pfn' => 0]);
            $this->vpeso = "false"; */
            $this->mostrar = "false"; $this->mostrarm = "false";
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Venta Eliminada!']);
            $this->reset(['fechaventa', 'cedulav', 'nombre', 'idlugarv', 'idestatuspagov', 'idtipopagov', 'placav', 'observaciones', 'idventa', 'idproductov', 'cantidadprov', 'precioprov', 'recepcionmaterial_id', 'messages']);
        }
    }
    
    public function render()
    {
        $vendedores = Cliente::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $venta = Venta::latest('id')->first();
        $materiales = Material::all();
        $este=$this->venta;                                    
        $productosrecepcion=DetalleVenta::all()->where('idventa',$this->recepcionmaterial_id);
        return view('livewire.ventas.venta', /* [
                    'materiales'=>$materiales,
            ], */ compact('vendedores', 'lugares', 'productos', 'venta', 'productosrecepcion'/* , 'traesuma' */));
    }
}