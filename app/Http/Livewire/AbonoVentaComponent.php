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
use App\Models\Inventario;
use App\Models\NegociacionVenta;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
//use Illuminate\Http\Request;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AbonoVentaComponent extends Component
{
    public $fechaventa, $cedulav, $nombre, $idlugarv, $idestatuspagov, $idtipopagov, $placav, $observacionesv, $idventa, $idproductov, $cantidadprov, $precioprov, $totalprov, $totalpronegn;
    public $venta, $mostrar='false', $mostrarm='false'; 
    public $horaventa, $pesofullv, $pesovaciov, $pesonetov, $pesocalculadov, $totalcomrav, $totalpagadov, $diferenciapagov, $ajusteporpesov, $totalacumulado;

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
            'observacionesv' => $this->observacionesv,
            'despachado' => 'NO'
        ]);
        $this->mostrar = "true"; $this->mostrarm = "true";
        $recepcion = Venta::latest('id')->first();
        $this->recepcionmaterial_id=$recepcion->id;
        /* session(['ptn' => 0]); session(['pfn' => 0]); */
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Negociación Generada']);
    }

    public function update($venta, $totalcalculado)    {
        $this->validate();
        //$this->fechacomprau = date('d-m-Y');
        //$recepcion = Almacen::find($this->recepcionmaterial_id);
        
        $datosc = Venta::find($venta);
        $datosc->update([
            'fechanventa' => date('d-m-Y'),
            'hora' => date("H:i:s"),
            'cedulav' => $this->cedulav,
            'idlugarv' => $this->idlugarv,
            'idestatuspagov' => $this->idestatuspagov,
            'idtipopagov' => $this->idtipopagov,
            'placav' => $this->placav,
            'totalcomrav' => (double)session('totalacumulado'),
            'observacionesv' => $this->observacionesv
        ]);
        /* $recepcion->update([
           'facturado' => 'SI'
        ]); */
        $productosventa=DetalleVenta::all()->where('idventa',$venta);
        foreach ($productosventa as $productoventa){
            //guardar la compra en el inventario
            //buscar la existena del producto en la tabla producto

            $existenciapro=Producto::find($productoventa->idproductov);
            $datosInventario = Inventario::create([
                'fecha' => date('d-m-Y'),
                'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
                'idproducto' => $existenciapro->id,
                'comprados' => 0,
                'vendidos' => (double)$productoventa['cantidadprov'],
                'existencia' => (double)$existenciapro->cantidad
            ]);
            //actualizar la existencia en la tabla del producto
            $datospro = Producto::find($productoventa->idproductov);
            $nexistencia = $existenciapro->cantidad-$productoventa['cantidadprov'];
            $datospro->update([
                'cantidad' => (double)$nexistencia
            ]);
        }
        $this->mostrar = "false"; $this->mostrarm = "false";
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Compra de Material Realizada!']);
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Se actualizó el Inventário!']);
        $this->reset(['fechaventa', 'cedulav', 'nombre', 'idlugarv', 'idestatuspagov', 'idtipopagov', 'placav', 'observaciones', 'idventa', 'idproductov', 'cantidadprov', 'precioprov', 'recepcionmaterial_id', 'messages', 'totalacumulado']);
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
    
    /* public function render()
    {
        $vendedores = Cliente::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $venta = Venta::latest('id')->first();
        $materiales = Material::all();
        $este=$this->venta;                                    
        $productosrecepcion=DetalleVenta::all()->where('idventa',$this->recepcionmaterial_id);
        return view('livewire.ventas.venta', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'venta', 'productosrecepcion'/* , 'traesuma' * /));
    } */

    public function abonar(){
        dd('prueba');
        /*$existencia=Producto::find($this->idproductov);
        $this->muesdesmaterial=$existencia['cantidad'];
        if($this->muesdesmaterial<$this->cantidadprov){
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'No puede agregar esa cantidad, actualmente tiene '.$this->muesdesmaterial.' KG disponible(s)']);
        }else{
            $nrm=Producto::find($nrmabono);
            dd($nrm);
            $nrm = Venta::count();
            if($nrm==0){ $nrm = 1; }else{ ++$nrm; }       
            $datos = Venta::create([
                'id' => $nrm,
                'fechanventa' => $this->fecha,
                'cedulav' => $this->cedulav,
                'idtipopagov' => 3,
                'placav' => $this->placav,
                'observacionesv' => $this->observacionesv,
                'despachado' => 'NO'
            ]);
            
            DetalleVenta::create([
                'idventa' => $this->recepcionmaterial_id,
                'idproductov' => $this->idproductov,
                'cantidadprov' => (double)$this->cantidadprov,
                'precioprov' => (double)$this->precioprov,
                'totalprov' => (double)$this->totalprov
            ]);
            $this->reset(['totalpronegn']);

            /* $recepcion = Venta::latest('id')->first();
            $this->recepcionmaterial_id=$recepcion->id; * /
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Material Abonado']);
        }*/
    }

    /* public function eliminarabono(DetalleVenta $detalleventa){
        (double)$this->pmmdn=$detalleventa->totalpronegn;
        $detalleventa->delete();
        $this->reset(['idproductov', 'cantidadprov', 'precioprov', 'totalprov']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado!']);
    } */

    public function render($id){
        
    //public function show($id){  // MUESTRA LA VISTA DE ABONOS

        $negociacion=NegociacionVenta::where('id', $id)->where('finalizada','NO')->get();
        $cliente = Cliente::where('cedulac', $negociacion[0]->cedulan)->get();
        $recepcionmaterial_id = $negociacion[0]->id;
        $productos=DB::table('detalle_negociacion_ventas')
            ->join('_pproductos', 'detalle_negociacion_ventas.producto_idn', '=', '_pproductos.id')
            ->where('negociacion_id',$negociacion[0]->id)->get();
        $productosabonados=DB::table('ventas')
            ->join('detalle_ventas', 'detalle_ventas.idventa', '=', 'ventas.id')
            ->join('_pproductos', '_pproductos.id', '=', 'detalle_ventas.idproductov')
            ->where('ventas.negociacion_id',$negociacion[0]->id)->get();
        /* return view('livewire.ventas.abono', 
                compact('negociacion', 'cliente', 'recepcionmaterial_id', 'productos', 'productosabonados')); */
        return view('livewire.abono-venta-component', 
                compact('negociacion', 'cliente', 'recepcionmaterial_id', 'productos', 'productosabonados'));
    }
}
