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
use App\Models\DespachoMaterial;
use App\Models\ConsultaAbonoNegociacionVenta;
use App\Models\ConsultaAmortizacionNegociacionVenta;
use App\Models\AbonoMaterialNegociacionVentas;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
//use Illuminate\Http\Request;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\DB;

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
    public $fechaventa, $cedulav, $nombre, $idlugarv, $idestatuspagov, $idtipopagov, $placav, $observacionesv, $idventa, $idproductov, $cantidadprov, $precioprov, $totalprov, $totalpronegn;
    public $venta, $mostrar='false', $mostrarm='false'; 
    public $horaventa, $pesofullv, $pesovaciov, $pesonetov, $pesocalculadov, $totalcomrav, $totalpagadov, $diferenciapagov, $ajusteporpesov, $totalacumulado;

    public $negociacion_id;

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
    public $editm_id, $traesuma='NO', $mostrarnegociacion='false', $cantidades;
    public $pesoabonarv, $mabonar='true', $mostrarabono='false';
    public $negociacion;

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

    public function destroyabonomaterial(AbonoMaterialNegociacionVentas $abonomaterialnv){
        $datosc = DetalleNegociacionVenta::where('negociacion_id', $abonomaterialnv->negociacion_id)
                            ->where('producto_idn', $abonomaterialnv->idproducton)->get()->pluck('cantidadprorecmatndebe');
        $debe = (double)$datosc[0]+(double)$abonomaterialnv->cantidadpron;
        $datosc = DetalleNegociacionVenta::where('negociacion_id', $abonomaterialnv->negociacion_id)
                            ->where('producto_idn', $abonomaterialnv->idproducton)->get();
        $datosc[0]->update([
            'cantidadprorecmatndebe' => (double)$debe
        ]);
        $abonomaterialnv->delete();
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado del Abono!']);
    }

    public function calpeso(){ //CALCULA EL PESO NETO
        if((is_numeric($this->cantidadprov)) and (is_numeric($this->precioprov))){
            $this->totalprov=$this->cantidadprov * $this->precioprov;
            //session(['totalcalculado' => $this->totalcalculado+$this->totalprov]);
        }
    }

    public function verificarpeso($id){ //CALCULA EL PESO DISPONIBLE
        if(session('cantidadprorecmatndebe'.$id) >= $this->cantidadprov){
            $this->pesoabonarv="";
            $this->mabonar='true';
        }else{ 
            $this->pesoabonarv="SOLO DEBE ".session('cantidadprorecmatndebe'.$id)." KG, INGRESE UNA CANTIDAD MENOR";
            $this->mabonar='false';
        }       
    }

    public function busproc(){ //BUSCA LOS PROVEEDORES
        $probc=Cliente::where('cedulac',$this->cedulav)->get()->pluck('nombrec');
        $this->nombre = isset($probc) ? $probc : "NO EXISTE";
    }

    public $negociaciones;
    public function busnegc($cedula){ //BUSCA LAS NEGOCIACIONES DE LOS PROVEEDORES
        /* dd($idtipopagov);
        if($idtipopagov==3){ */
            $negociaciones=NegociacionVenta::where('cedulan', $cedula)
                                            ->where('finalizada','NO')->get();
            //$this->negociaciones=$negociacionescli;
            return $negociaciones;
        /* } */
    }

    public $negociacionescredito;
    public function busnegccredito($cedula){ //BUSCA LAS NEGOCIACIONES DE LOS PROVEEDORES
        /* dd($idtipopagov);
        if($idtipopagov==3){ */
            $negociacionescredito=NegociacionVenta::where('cedulan', $cedula)
            ->where('idtipopagon', 2)             ->where('finalizada','NO')->get();
            //$this->negociaciones=$negociacionescli;
            //dd($negociacionescredito);
            return $negociacionescredito;
        /* } */
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
        //$nrm = Venta::count();
        $nrm = Venta::latest('id')->first();
        if($nrm->id==0){ $nrm = 1; }else{ $nrm = ++$nrm->id; }
        if($this->idtipopagov==1){ $this->idestatuspagov=1; }else{ $this->idestatuspagov=2; }
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
        if($this->idtipopagov==3){
            $this->idestatuspagov=1; $this->cantidadprov=0; $this->precioprov=0;
        }
        /* dd($this->idestatuspagov=1
            .' - '.$this->cantidadprov
            .' - '.$this->precioprov); */
        $this->validate();
        //$this->fechacomprau = date('d-m-Y');
        //$recepcion = Almacen::find($this->recepcionmaterial_id);
        
        $datosc = Venta::find($venta);
        if($this->idtipopagov!=3){
            $datosc->update([
                'fechaventa' => date('d-m-Y'),
                'horaventa' => date("H:i:s"),
                'cedulav' => $this->cedulav,
                'idlugarv' => $this->idlugarv,
                'idestatuspagov' => $this->idestatuspagov,
                'idtipopagov' => $this->idtipopagov,
                'placav' => $this->placav,
                'totalcomrav' => (double)session('totalacumulado'),
                'observacionesv' => $this->observacionesv
            ]);
        }else{
            $datosc->update([
                'fechaventa' => date('d-m-Y'),
                'horaventa' => date("H:i:s"),
                'cedulav' => $this->cedulav,
                'idlugarv' => $this->idlugarv,
                //'idestatuspagov' => $this->idestatuspagov,
                //'idtipopagov' => $this->idtipopagov,
                'placav' => $this->placav,
                //'totalcomrav' => (double)session('totalacumulado'),
                'observacionesv' => $this->observacionesv
            ]);
        }
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
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Venta de Material Realizada!']);
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Se actualizó el Inventário!']);
        $this->reset(['fechaventa', 'cedulav', 'nombre', 'idlugarv', 'idestatuspagov', 'idtipopagov', 'placav', 'observaciones', 'idventa', 'idproductov', 'cantidadprov', 'precioprov', 'recepcionmaterial_id', 'messages', 'totalacumulado', 'venta']); 
    }
    
    public function default($recepcionmaterial_id)    {
        $nc = DetalleVenta::where('idventa',$recepcionmaterial_id)->get()->count();
        if($nc>0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Elimine los Materiales o los Abonos de Materiales para poder Cancelar la Venta']);
        }else{
            $user = Venta::findOrFail($recepcionmaterial_id);
            $user->delete();
            /* session(['ptn' => 0]); session(['pfn' => 0]);
            $this->vpeso = "false"; */
            $this->mostrar = "false"; $this->mostrarm = "false";
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Venta Eliminada!']);
            $this->reset(['fechaventa', 'cedulav', 'nombre', 'idlugarv', 'idestatuspagov', 'idtipopagov', 'placav', 'observaciones', 'idventa', 'idproductov', 'cantidadprov', 'precioprov', 'recepcionmaterial_id', 'messages', 'venta']);
        }
    }
    
    public function nuevoabono(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES       
        $this->mostrar = "true"; $this->mostrarm = "true"; $this->mostrarabono = "true";
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Abono Generado']);
    }

    public function defaultabono()    {
            $this->mostrar = "false"; $this->mostrarm = "false"; $this->mostrarabono = "false";
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Abono Cancelado!']);
            $this->reset(['fechaventa', 'cedulav', 'nombre', 'idlugarv', 'idestatuspagov', 'idtipopagov', 'placav', 'observaciones', 'idventa', 'idproductov', 'cantidadprov', 'precioprov', 'recepcionmaterial_id', 'messages', 'venta']);
        //}
    }

    public function calrestaneg($montotn){ //CALCULA EL PAGO
        //dd($montotn[0]);
        if((double)$montotn==0){
            $this->validamontotn="NO DEBE";
            $this->totalpagoneg=0;
            $this->restapagoneg=0;
        }elseif(((double)$this->pagoefectivoneg+(double)$this->pagotransfneg)>(double)$montotn[0]){
                $this->validamontotn="TOTAL DEBE SER MENOR O IGUAL A: ".(double)$montotn[0];
                $this->totalpagoneg=round((double)$this->pagoefectivoneg + (double)$this->pagotransfneg,2);
                $this->restapagoneg=round((double)$montotn[0]-(double)$this->totalpagoneg,2);

        }else{
            if((is_numeric((double)$this->pagoefectivoneg)) or (is_numeric((double)$this->pagotransfneg))){
                //$idtipopagoneg, $pagoefectivoneg, $pagotransfneg, $totalpagoneg;
                $this->validamontotn="";
                $this->totalpagoneg=round((double)$this->pagoefectivoneg + (double)$this->pagotransfneg,2);
                $this->restapagoneg=round((double)$montotn[0]-(double)$this->totalpagoneg,2);
            }
        }
    }

    public $pagoefectivoneg, $pagotransfneg, $totalpagoneg, $restapagoneg, $validamontotn; //$mostrarpagoneg='false';
    public function guardaramortizacion(){
        $pagonegventa = PagoNegociacionVenta::create([
            'negociacion_id' => $this->recepcionmaterial_id,
            'fechapagonegven' => date('d-m-Y'),
            'horapagonegven' => date("H:i:s"),
            'montoefec' => (double)$this->pagoefectivoneg,
            'montotran' => (double)$this->pagotransfneg,
            'totalpago' => (double)$this->pagoefectivoneg+(double)$this->pagotransfneg,
            'restapago' => $this->restapagoneg
        ]);
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
        $productosabonar=DB::table('detalle_negociacion_ventas')
            ->join('_pproductos', 'detalle_negociacion_ventas.producto_idn', '=', '_pproductos.id')
            /* ->where('negociacion_id',$negociacion[0]->id) */->get();
        /* $productosabonados=DB::table('ventas')
            ->join('detalle_ventas', 'detalle_ventas.idventa', '=', 'ventas.id')
            ->join('_pproductos', '_pproductos.id', '=', 'detalle_ventas.idproductov')
            ->get(); */

        $productosabonados=ConsultaAbonoNegociacionVenta::all();
        
        //$productosabonados=AbonoMaterialNegociacionVentas::all();
        $amortizacionesdepago=ConsultaAmortizacionNegociacionVenta::all();

        return view('livewire.ventas.venta', [
                    'materiales'=>$materiales,
            ], compact('vendedores', 'lugares', 'productos', 'venta', 'productosrecepcion', 'productosabonar', 'productosabonados', 'amortizacionesdepago'));
    }

    public function abonar($negociacion_id){
        if($this->cantidadprov==""){
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Ingrese una cantidad']);
        }else{
            $existencia=Producto::find($this->idproductov);
            $this->muesdesmaterial=$existencia['cantidad'];
        if($this->muesdesmaterial<$this->cantidadprov){
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'No puede agregar esa cantidad, actualmente tiene '.$this->muesdesmaterial.' KG disponible(s)']);
        }else{
            /* $despacho = DespachoMaterial::latest('id')->first(); */
            AbonoMaterialNegociacionVentas::create([
                'negociacion_id' => $negociacion_id,
                'idproducton' => $this->idproductov,
                'cantidadpron' => (double)$this->cantidadprov,
                /* 'despachado' => $despacho->id */
            ]);

            $datosc = DetalleNegociacionVenta::where('negociacion_id', $this->negociacion_id)
                                ->where('producto_idn', $this->idproductov)->get()->pluck('cantidadprorecmatndebe');
            $debe = (double)$datosc[0]-(double)$this->cantidadprov;

            $datosc = DetalleNegociacionVenta::where('negociacion_id', $this->negociacion_id)
                                ->where('producto_idn', $this->idproductov)->get();
            
            $datosc[0]->update([
                'cantidadprorecmatndebe' => (double)$debe
            ]);
            $this->cantidadprov="";
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Material Abonado']);
        }
        }
    }

    public function generardespacho(){
        //$this->validate();
        $nc = AbonoMaterialNegociacionVentas::where('negociacion_id',$this->negociacion_id)->get()->count();
        if($nc==0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Agrege Materiales para Generar el Despacho']);
        }else{//GENERAR DESPACHO
            DespachoMaterial::create([
                'fechaventad'=> date('d-m-Y'),
                'horaventad' => date("H:i:s"),
                'idestatusd' => 1
            ]);
            $despacho = DespachoMaterial::latest('id')->first();
            $productosabonados = AbonoMaterialNegociacionVentas::where('negociacion_id',$this->negociacion_id)->get();
            foreach ($productosabonados as $productoabonado){
                $datosdc = AbonoMaterialNegociacionVentas::where('negociacion_id', $this->negociacion_id)
                    ->where('idproducton', $productoabonado['idproducton']);
                $datosdc->update(['iddespacho' => $despacho->id]);
                $existenciapro=Producto::find($productoabonado['idproducton']);
                $datosInventario = Inventario::create([
                    'fecha' => date('d-m-Y'),
                    'hora' => date("H:i:s"),
                    'idproducto' => $productoabonado['idproducton'],
                    'comprados' => 0,
                    'vendidos' => (double)$productoabonado['cantidadpron'],
                    'existencia' => (double)$existenciapro->cantidad
                ]); //actualizar la existencia en la tabla del producto
                $datospro = Producto::find($productoabonado['idproducton']);
                $nexistencia = $existenciapro->cantidad-$productoabonado['cantidadpron'];
                $datospro->update(['cantidad' => (double)$nexistencia]);
            }
            $this->mostrar = "false"; $this->mostrarm = "false";
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Abono de Material Generado!']);
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Se actualizó el Inventário!']);
            $this->reset(['fechaventa', 'cedulav', 'nombre', 'idlugarv', 'idestatuspagov', 'idtipopagov', 'placav', 'observaciones', 'idventa', 'idproductov', 'cantidadprov', 'precioprov', 'recepcionmaterial_id', 'messages', 'totalacumulado', 'venta']);
        }
    }

    /* public function eliminarabono(DetalleVenta $detalleventa){
        (double)$this->pmmdn=$detalleventa->totalpronegn;
        $detalleventa->delete();
        $this->reset(['idproductov', 'cantidadprov', 'precioprov', 'totalprov']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado!']);
    } */

    /* public function show($id){  // MUESTRA LA VISTA DE ABONOS
        dd($id);
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
        return view('livewire.ventas.abono', 
                compact('negociacion', 'cliente', 'recepcionmaterial_id', 'productos', 'productosabonados'));
    } */
}
