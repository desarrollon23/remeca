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
use App\Models\Cliente;
use App\Models\Detallealmacen;
use App\Models\DetalleNegociacionVenta;
use App\Models\Inventario;
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

class NegociacionComponent extends Component
{
    /* public function __construct() //PROTEGE LAS RUTAS PARA QUE NO LA ABRA UN USUARIO SI NO TIENE PERMISO
    {
        $this->middleware('can:livewire.almacen.material-reception.index')->only('index');
        $this->middleware('can:livewire.almacen.material-reception.create')->only('create', 'store');
        $this->middleware('can:livewire.almacen.material-reception.edit')->only('edit', 'update');
        $this->middleware('can:livewire.almacen.material-reception.destroy')->only('destroy');
    } */
    
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
        //'idlugarn' => 'required',
        'idtipopagon' => 'required',
        'idtipoabonon' => 'required',
        'observaciones' => 'required|max:250',
        'producto_idn' => 'required',
        'cantidadprorecmatn' => 'required|max:8',
        'precionegn' => 'required|max:8',
    ];

    protected $validationattributs = [
        //'fechan' => 'Fecha',
        'cedulan' => 'Cédula',
        'nombren' => 'Nombre',
        //'idlugarn' => 'Lugar',
        'idtipopagon' => 'Tipo de Pago',
        'idtipoabonon' => 'Tipo de Abono',
        'observaciones' => 'Observaciones',
        'producto_idn' => 'Material',
        'cantidadprorecmatn' => 'Cantidad',
        'precionegn' => 'Precio',
    ];

    protected $messages = [
        'cedulan.required' => 'Ingrese la Cédula',
        'cedulan.max' => 'Máximo 15 Cífras',
        'nombren.required' => 'Ingrese el Nombre',
        'nombren.max' => 'Máximo 50 caracteres',
        //'idlugarn' => 'Seleccione Lugar',
        'idtipopagon.required' => 'Seleccione Tipo de Pago',
        'idtipoabonon.required' => 'Seleccione Tipo de Abono',
        'observaciones.required' => 'Ingrese Observaciones',
        'observaciones.max' => 'Máximo 250 letras',
        'producto_idn.required' => 'SELECCIONE',
        'cantidadprorecmatn.required' => 'INGRESE',
        'cantidadprorecmatn.max' => 'MAXIMO 8 CIFRAS',
        'precionegn.required' => 'INGRESE',
        //'totalpronegn.required' => 'SELECCIONE'
    ];

    public function storem()    {   //AGREGA MATERIALES A LA LISTA
        $this->validate();
        $existencia=Producto::find($this->producto_idn);
        $this->muesdesmaterial=$existencia['cantidad'];
        //dd($this->muesdesmaterial);
        if($this->muesdesmaterial<$this->cantidadprorecmatn){
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'No puede agregar esa cantidad, actualmente tiene '.$this->muesdesmaterial.' KG disponible(s)']);
        }else{
            DetalleNegociacionVenta::create([
                'negociacion_id' => $this->recepcionmaterial_id,
                'producto_idn' => $this->producto_idn,
                'cantidadprorecmatn' => (double)$this->cantidadprorecmatn,
                'precionegn' => (double)$this->precionegn,
                'totalpronegn' => (double)$this->totalpronegn
            ]);
            //session(['tpn' => (double)session('tpn')+(double)$this->totalpronegn]);
            $this->reset([/* 'negociacion_id', 'producto_idn', 'cantidadprorecmatn', 'precionegn', */ 'totalpronegn']);
            $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material agregado correctamente!']);

            //guardar la compra en el inventario
            //buscar la existena del producto en la tabla producto
            /* $existenciapro=Producto::find($this->producto_id);
            $datosInventario = Inventario::create([
                'fecha' => $this->fechacomprau,
                'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
                'idproducto' => $this->producto_id,
                'comprados' => 0,
                'vendidos' => (double)$this->cantidadprorecmatn,
                'existencia' => (double)$existenciapro->cantidad
            ]);
            //actualizar la existencia en la tabla del producto
            $datospro = Producto::find($this->producto_id);
            $nexistencia = $existenciapro->cantidad+$this->cantidadprorecmatn;
            $datospro->update([
                'cantidad' => (double)$nexistencia
            ]); */
        }
    }

    public function destroy(DetalleNegociacionVenta $detallenegociacionventa){
        (double)$this->pmmdn=$detallenegociacionventa->totalpronegn;
        $detallenegociacionventa->delete();

        //guardar la compra en el inventario
            //buscar la existena del producto en la tabla producto
            /* $existenciapro=Producto::find($this->producto_id);
            $datosInventario = Inventario::create([
                'fecha' => $this->fechacomprau,
                'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
                'idproducto' => $this->producto_id,
                'comprados' => 0,
                'vendidos' => (double)$this->cantidadprorecmatn,
                'existencia' => (double)$existenciapro->cantidad
            ]);
            //actualizar la existencia en la tabla del producto
            $datospro = Producto::find($this->producto_id);
            $nexistencia = $existenciapro->cantidad+$this->cantidadprorecmatn;
            $datospro->update([
                'cantidad' => (double)$nexistencia
            ]); */

        //session(['tpn' => (double)session('tpn')-(double)$this->pmmdn]);
        $this->reset(['producto_idn', 'cantidadprorecmatn', 'precionegn', 'totalpronegn']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado!']);
    }

    public function calpeso(){ //CALCULA EL PESO NETO
        if((is_numeric($this->cantidadprorecmatn)) and (is_numeric($this->precionegn))){
            $this->totalpronegn=$this->cantidadprorecmatn * $this->precionegn;
            //session(['totalcalculado' => $this->totalcalculado+$this->totalpronegn]);
        }
    }

    public function busproc(){ //BUSCA LOS PROVEEDORES
        $probc=Cliente::where('cedulac',$this->cedulan)->get()->pluck('nombrec');
        $this->nombren = isset($probc) ? $probc : "NO EXISTE";
    }

    public function buspron(){ //BUSCA LOS PROVEEDORES
        $probn=Cliente::where('nombrec',$this->nombren)->get()->pluck('cedulac');
        $this->cedulan = isset($probn) ? $probn : "NO EXISTE";
    }

    public function traedesmaterial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['descripcion'];
        return $this->muesdesmaterial;
    }

    public function generar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES       
        $nrm = NegociacionVenta::count();       
        if($nrm==0){ $nrm = 1; }else{ ++$nrm; }       
        $datos = NegociacionVenta::create([
            'id' => $nrm,           
            'fechan' => $this->fecha,
            'cedulan' => $this->cedula,
            //'idlugarn' => $this->idlugar,
            'idtipopagon' => $this->idtipopagon,
            'idtipoabonon' => $this->idtipoabonon,
            'observaciones' => $this->observaciones,
            'finalizada' => 'NO',
            //'facturado' => 'NO'
        ]);
        $this->mostrar = "true"; $this->mostrarm = "true";
        $recepcion = NegociacionVenta::latest('id')->first();
        $this->recepcionmaterial_id=$recepcion->id;
        /* session(['ptn' => 0]); session(['pfn' => 0]); */
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Negociación Generada']);
    }

    public function update($recepcionmaterial_id)    {
        $this->validate();
        $this->fecha = date('d-m-Y');
        $datos = NegociacionVenta::find($recepcionmaterial_id);
        $datos->update([
            //'id' => $nrm,       
            'fechan' => $this->fecha,
            'cedulan' => $this->cedulan,
            //'idlugarn' => $this->idlugar,
            'idtipopagon' => $this->idtipopagon,
            'idtipoabonon' => $this->idtipoabonon,
            'observaciones' => $this->observaciones,
            'finalizada' => 'NO',
            //'facturado' => 'NO'
        ]);                
        $this->mostrar = "false"; $this->mostrarm = "false";
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Negociación Actualizada!']);
        $this->reset(['fechan', 'cedulan', 'nombren', 'idtipopagon', 'idtipoabonon', 'observaciones', 'negociacion_id', 'producto_idn', 'cantidadprorecmatn', 'precionegn', 'totalpronegn', 'recepcionmaterial_id', 'messages']);
    }
    
    public function default($recepcionmaterial_id)    {
        $nc = DetalleNegociacionVenta::where('negociacion_id',$recepcionmaterial_id)->get()->count();
        if($nc>0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Elimine los Materiales para poder Cancelar la Negociación']);
        }else{
            $user = NegociacionVenta::findOrFail($recepcionmaterial_id);
            $user->delete();
            /* session(['ptn' => 0]); session(['pfn' => 0]);
            $this->vpeso = "false"; */
            $this->mostrar = "false"; $this->mostrarm = "false";
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Negociación  Eliminada!']);
            $this->reset(['fechan', 'cedulan', 'nombren', 'idtipopagon', 'idtipoabonon', 'observaciones', 'negociacion_id', 'producto_idn', 'cantidadprorecmatn', 'precionegn', 'totalpronegn', 'recepcionmaterial_id', 'messages']);
        }
    }
    
    public function render()
    {
        //$recepcionmaterial_id=7;
        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $recepcion = NegociacionVenta::latest('id')->first();
        $materiales = Material::all();
        $este=$this->recepcion;                                    
        $productosrecepcion=DetalleNegociacionVenta::all()->where('negociacion_id',$this->recepcionmaterial_id);
        return view('livewire.ventas.negociacion', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion'/* , 'traesuma' */));
    }
}
