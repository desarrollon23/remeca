<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use App\Models\Venta;
use App\Models\Material;
use App\Models\almacen;
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

class VentasComponent extends Component
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
        //'fechaventa' => 'required', 
        //'horaventa' => 'required', 
        'cedulav' => 'required|max:15',
        'nombren' => 'required|max:50',
        'idlugarv' => 'required', 
        //'pesofullv' => 'required|max:8',
        //'pesovaciov' => 'required|max:8',
        //'pesonetov' => 'required|max:8',
        //'pesocalculadov' => 'required|max:8',
        'idestatuspagov' => 'required',
        'idtipopagov' => 'required',
        'placav' => 'required',
        //'totalcomrav' => 'required|max:8', 
        //'totalpagadov' => 'required|max:8', 
        //'diferenciapagov' => 'required|max:8',
        //'ajusteporpesov' => 'required|max:8',
        'observacionesv' => 'required|max:250',
        'idproductov' => 'required',
        'cantidadprov' => 'required|max:8',
        //'operacionv' => 'required',
        'precioprov' => 'required|max:8',
        //'totalprov' => 'required|max:8'
    ];

    protected $validationattributs = [
        //'fechaventa' => 'required', 
        //'horaventa' => 'Hora', 
        'cedulav' => 'Cédula',
        'nombren' => 'Nombre',
        'idlugarv' => 'Lugar', 
        //'pesofullv' => 'Peso FULL',
        //'pesovaciov' => 'Peso VACIO',
        //'pesonetov' => 'Peso NETO',
        //'pesocalculadov' => 'Peso CALCULADO',
        'idestatuspagov' => 'Estatus de Pago',
        'idtipopagov' => 'Tipo de Pago',
        'placav' => 'Placa Camión',
        //'totalcomrav' => 'Total Compra', 
        //'totalpagadov' => 'Total Pagado', 
        //'diferenciapagov' => 'Diferencia de Pago',
        //'ajusteporpesov' => 'Ajuste por Peso',
        'observacionesv' => 'Observaciones',
        'idproductov' => 'MATERIAL',
        'cantidadprov' => 'CANTIDAD',
        //'operacionv' => 'required',
        'precioprov' => 'PRECIO',
        //'totalprov' => 'TOTAL'
    ];

    protected $messages = [
        //'fechaventa' => 'required', 
        //'horaventa' => 'required', 
        'cedulav' => 'Ingrese Cédula',
        'nombren' => 'Ingrese Nombre',
        'idlugarv' => 'Seleccione', 
        //'pesofullv' => 'required',
        //'pesovaciov' => 'required',
        //'pesonetov' => 'required',
        //'pesocalculadov' => 'required',
        'idestatuspagov' => 'Seleccione',
        'idtipopagov' => 'Seleccione',
        //'totalcomrav' => 'required', 
        //'totalpagadov' => 'required', 
        //'diferenciapagov' => 'required',
        //'ajusteporpesov' => 'required',
        'observacionesv' => 'Ingrese Observaciones',
        'idproductov' => 'SELECCIONE',
        'cantidadprov' => 'INGRESE',
        //'operacionv' => 'required',
        'precioprov' => 'INGRESE',
        //'totalprov' => 'required'
    ];

    

    public function storem()    {
        /* 'cedulav' => 'required|max:15',
    'nombren' => 'required|max:50',
    'idlugarv' => 'required', 
    'idestatuspagov' => 'required',
    'idtipopagov' => 'required',
    'placav' => 'required',
    'observacionesv' => 'required|max:250',
    'idproductov' => 'required',
    'cantidadprov' => 'required|max:8',
    'precioprov' => 'required|max:8', */
    }

    public function destroy(Material $material){
        
    }

    public function calpeso(){ //CALCULA EL PESO NETO
        
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
        
    }

    public function update($recepcionmaterial_id)    {
        
    }
    
    public function default($recepcionmaterial_id)    {
        
    }
    
    public function render()
    {
        //$vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $venta = VentasComponent::latest('id')->first();
        //$materiales = Material::all();
        $este=$this->venta;                                    
        $productosrecepcion=DetalleVenta::all()->where('negociacion_id',$this->recepcionmaterial_id);
        return view('livewire.ventas.venta', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'venta', 'productosrecepcion'/* , 'traesuma' */));
    }
}
