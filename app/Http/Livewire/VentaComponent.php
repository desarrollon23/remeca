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
use App\Models\PagoNegociacionVenta;
use App\Models\Liquidez;
use App\Models\CuentasPorCobrarVentas;
use App\Models\DetalleCuentasPorCobrarVentas;
use App\Models\DetalleDespacho;
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
    public $pesoabonarv, $mabonar='true', $mostrarabono='false', $mostrarpagoventa='false';
    public $negociacion;

    public $totalpagoven, $restapagoven, $pagoefectivoven, $pagotransfven, $restaven, $ocultarbotonven='false', $validamontotv;

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
        'observacionesv' => 'required|max:250'/* ,
        'idproductov' => 'required',
        'cantidadprov' => 'required|max:12',
        'precioprov' => 'required|max:12', */
    ];

    protected $validationattributs = [
        'cedulav' => 'Cédula',
        'nombre' => 'Nombre',
        'idlugarv' => 'Lugar',
        'idestatuspagov' => 'Estatus de Pago',
        'idtipopagov' => 'Tipo de Pago',
        'placav' => 'Placa Camión',
        'observacionesv' => 'Observaciones'/* ,
        'idproductov' => 'MATERIAL',
        'cantidadprov' => 'CANTIDAD',
        'precioprov' => 'PRECIO', */
    ];

    protected $messages = [
        'cedulav' => 'Ingrese Cédula',
        'nombre' => 'Ingrese Nombre',
        'idlugarv' => 'Seleccione', 
        'idestatuspagov' => 'Seleccione',
        'idtipopagov' => 'Seleccione',
        'observacionesv' => 'Ingrese Observaciones'/* ,
        'idproductov' => 'SELECCIONE',
        'cantidadprov' => 'INGRESE',
        'precioprov' => 'INGRESE', */
    ];

    public function storem(){ //AGREGAR MATERIAL EN VENTAS DE CONTADO Y A CREDITO
        if($this->idproductov=='NULL' or $this->cantidadprov==null or $this->precioprov==null){
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Seleccione el Material, Ingrese el peso y el Precio']);
        }else{
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
                $this->mostrarpagoventa='true';
                if($this->idtipopagov==2){ $this->ocultarbotonven="true"; }
                auditar('VENTA #: '.$this->recepcionmaterial_id, 'AGREGAR MATERIAL');
                $this->reset(['idproductov', 'cantidadprov', 'precioprov', 'totalprov']);
                $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material agregado correctamente!']);
            }
        }
        $this->render();
    }

    public function destroy(DetalleVenta $detalleventa){ //ELIMINAR MATERIAL EN VENTAS DE CONTADO Y A CREDITO
        (double)$this->pmmdn=$detalleventa->totalpronegn;
        $detalleventa->delete();
        auditar('VENTA #: '.$this->recepcionmaterial_id, 'ELIMINAR MATERIAL');
        $this->reset(['idproductov', 'cantidadprov', 'precioprov', 'totalprov']);
        $this->dispatchBrowserEvent('hide-form', ['message' => '¡Material eliminado!']);
    }

    //ELIMINAR MATERIAL EN ABONO DE MATERIALES EN NEGOCIACIONES
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
        auditar('ABONO DE MATERIAL - NEGOCIACION #: '.$abonomaterialnv->negociacion_id, 'ELIMINAR MATERIAL');
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

    public function busproc(){ //BUSCA LOS NOMBRES DE LOS PROVEEDORES
        $probc=Cliente::where('cedulac',$this->cedulav)->get()->pluck('nombrec');
        $this->nombre = isset($probc) ? $probc : "NO EXISTE";
    }

    public $negociaciones;
    public function busnegc($cedula){ //BUSCA LAS CUENTAS POR PAGAR DE MATERIALES A LOS CLIENTES (negociaciones)
        $negociaciones=NegociacionVenta::where('cedulan', $cedula)
                                       ->where('finalizada','NO')->get();
        return $negociaciones;
    }

    public $negociacionescredito;
    public function busnegccredito($cedula){ //BUSCA LAS CUENTAS POR COBRAR DE VENTAS $ (negociaciones y creditos) A LOS CLIENTES
        $negociacionescredito= CuentasPorCobrarVentas::where('cedula', $cedula)
            ->where('finalizada','NO')->where('totalresta', '<>',0)->get();
        return $negociacionescredito;
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
    
    public function generar(){ //GENERA LAS VENTAS DE CONTADO O A CRÉDITO
        $nrm = Venta::latest('id')->first();
        if($nrm==null or $nrm->id==0){ $nrm = 1; }else{ $nrm = ++$nrm->id; }
        $datos = Venta::create([
            'id' => $nrm,           
            'fechaventa' => date('d-m-Y'),
            'horaventa' => date("H:i:s"),
            'despachado' => 'NO'
        ]);
        $this->mostrar = "true"; $this->mostrarm = "true";
        $this->recepcionmaterial_id=$nrm;
        auditar('VENTA #: '.$this->recepcionmaterial_id, 'GENERAR VENTA');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Negociación Generada']);
    }

    public function default($idventa){ //CANCELA LAS VENTAS DE CONTADO O A CREDITO
        $nc = DetalleVenta::where('idventa',$idventa)->get()->count();
        if($nc>0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Elimine los Materiales para poder Cancelar la Venta']);
        }else{
            $user = Venta::findOrFail($idventa);
            $user->delete();
            $this->mostrar = "false"; $this->mostrarm = "false";
            auditar('VENTA #: '.$idventa, 'CANCELAR VENTA');
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Venta Eliminada!']);
            session(['totalacumulado' => 0]);
            $this->reset();
        }
    }

    public $actefectivo, $acttransferencia, $iddespacho;
    public function update($venta, $totalcalculado){ //GUARDA LAS VENTAS DE CONTADO O A CREDITO
        if(($this->idtipopagov==1) and (session('totalacumulado')!=$this->totalpagoven)){
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'EL TIPO DE PAGO ES DE CONTADO, DEBE FACTURAR '.(double)session('totalacumulado').' ']);
        }else{
            if($this->idtipopagov==1){ //VENTA DE CONTADO
                $this->idestatuspagov=1;   /* $this->cantidadprov=0; $this->precioprov=0; */
                $this->validate(); //GENERAR DESPACHO
                DespachoMaterial::create([
                    'fechaventad'=> date('d-m-Y'),
                    'horaventad' => date("H:i:s"),
                    'cedula' => $this->cedulav,
                    'idestatusd' => 1
                ]); //ACTUALIZA LA VENTA
                $iddespacho = DespachoMaterial::latest('id')->first();
                if($this->pagoefectivoven>0){ $idtipoabonoven=1; }
                if($this->pagotransfven>0){ $idtipoabonoven=2; }
                if($this->pagotransfven>0 and $this->pagoefectivoven>0){ $idtipoabonoven=3; }
                if($this->pagotransfven=="" and $this->pagoefectivoven==""){ $idtipoabonoven=0; }
                if($this->idtipopagov==2){ $this->restapagoven = (double)session('totalacumulado'); }
                $datosc = Venta::find($venta);
                $datosc->update([
                    'fechaventa' => date('d-m-Y'),
                    'horaventa' => date("H:i:s"),
                    'cedulav' => $this->cedulav,
                    'idlugarv' => $this->idlugarv,
                    'idestatuspagov' => $this->idestatuspagov,
                    'idtipopagov' => $this->idtipopagov,
                    'efectivo' => (double)$this->pagoefectivoven,
                    'transferencia' => (double)$this->pagotransfven,
                    'idtipoabonov' => $idtipoabonoven,
                    'placav' => $this->placav,
                    'totalcomrav' => (double)session('totalacumulado'),
                    'totalpagadov' => (double)$this->totalpagoven,
                    'diferenciapagov' => (double)$this->restapagoven,
                    'observacionesv' => $this->observacionesv,
                    'iddespacho' => $iddespacho->id
                ]); //ACTUALIZA LA LIQUIDEZ
                $liquidez = Liquidez::find(1);
                $this->actefectivo=(double)$liquidez->efectivo+(double)$this->pagoefectivoven;
                $this->acttransferencia=(double)$liquidez->banco+(double)$this->pagotransfven;
                $liquidez->update([
                    'efectivo' => (double)$this->actefectivo,
                    'banco' => (double)$this->acttransferencia
                ]); //ACTUALIZA EL INVENTARIO
                $productosventa=DetalleVenta::all()->where('idventa',$venta);
                foreach ($productosventa as $productoventa){
                    DetalleDespacho::create([
                        'iddespacho' => $iddespacho->id,
                        'idproducto' => $productoventa['idproductov'],
                        'cantidadpro' => (double)$productoventa['cantidadprov'],
                        'despachado' => 'NO'
                    ]);
                    //guardar la compra en el inventario //buscar la existena del producto en la tabla producto
                    $existenciapro=Producto::find($productoventa->idproductov);
                    $datosInventario = Inventario::create([
                        'fecha' => date('d-m-Y'),
                        'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
                        'idproducto' => $existenciapro->id,
                        'comprados' => 0,
                        'vendidos' => (double)$productoventa['cantidadprov'],
                        'existencia' => (double)$existenciapro->cantidad
                    ]); //ACTUALIZA LA EXISTENCIA DEL PRODUCTO
                    $datospro = Producto::find($productoventa->idproductov);
                    $nexistencia = $existenciapro->cantidad-$productoventa['cantidadprov'];
                    $datospro->update(['cantidad' => (double)$nexistencia]);
                }
            }else{ $this->idestatuspagov=2; //VENTA A CREDITO
                $this->validate(); //GENERAR DESPACHO
                DespachoMaterial::create([
                    'fechaventad'=> date('d-m-Y'),
                    'horaventad' => date("H:i:s"),
                    'cedula' => $this->cedulav,
                    'idestatusd' => 1
                ]); //ACTUALIZA LA VENTA
                $iddespacho = DespachoMaterial::latest('id')->first();

                if($this->pagoefectivoven>0){ $idtipoabonoven=1; }
                if($this->pagotransfven>0){ $idtipoabonoven=2; }
                if($this->pagotransfven>0 and $this->pagoefectivoven>0){ $idtipoabonoven=3; }
                if($this->pagotransfven=="" and $this->pagoefectivoven==""){ $idtipoabonoven=0; }
                if($this->idtipopagov==2){ $this->restapagoven = (double)session('totalacumulado'); }
                $datosc = Venta::find($venta);
                $datosc->update([
                    'fechaventa' => date('d-m-Y'),
                    'horaventa' => date("H:i:s"),
                    'cedulav' => $this->cedulav,
                    'idlugarv' => $this->idlugarv,
                    'idestatuspagov' => $this->idestatuspagov,
                    'idtipopagov' => $this->idtipopagov,
                    'efectivo' => (double)$this->pagoefectivoven,
                    'transferencia' => (double)$this->pagotransfven,
                    'idtipoabonov' => $idtipoabonoven,
                    'placav' => $this->placav,
                    'totalcomrav' => (double)session('totalacumulado'),
                    'totalpagadov' => (double)$this->totalpagoven,
                    'diferenciapagov' => (double)$this->restapagoven,
                    'observacionesv' => $this->observacionesv,
                    'iddespacho' => $iddespacho->id
                ]); //ACTUALIZA EL INVENTARIO
                $productosventa=DetalleVenta::all()->where('idventa',$venta);
                foreach ($productosventa as $productoventa){ 
                    DetalleDespacho::create([
                        'iddespacho' => $iddespacho->id,
                        'idproducto' => $productoventa['idproductov'],
                        'cantidadpro' => (double)$productoventa['cantidadprov'],
                        'despachado' => 'NO'
                    ]);
                    //guardar la compra en el inventario //buscar la   existena del producto en la tabla producto
                    $existenciapro=Producto::find($productoventa->idproductov);
                    $datosInventario = Inventario::create([
                        'fecha' => date('d-m-Y'),
                        'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
                        'idproducto' => $existenciapro->id,
                        'comprados' => 0,
                        'vendidos' => (double)$productoventa['cantidadprov'],
                        'existencia' => (double)$existenciapro->cantidad
                    ]);  //ACTUALIZA LA EXISTENCIA DEL PRODUCTO
                    $datospro = Producto::find($productoventa->idproductov);
                    $nexistencia = $existenciapro->cantidad-$productoventa['cantidadprov'];
                    $datospro->update(['cantidad' => (double)$nexistencia]);
                } //CREA LA CUENTA POR COBRAR
                $datos = CuentasPorCobrarVentas::create([
                    'idventa' => $venta,
                    'idnegociacionventa' => 0,
                    'fecha' => date('d-m-Y'),
                    'hora' => date("H:i:s"),
                    'cedula' => $this->cedulav,
                    'montototal' => (double)session('totalacumulado'),
                    'totalefectivo' => (double)$this->pagoefectivoven,
                    'totaltransferencia' => (double)$this->pagotransfven,
                    'totalpagado' => (double)$this->pagoefectivoven+(double)$this->pagotransfven,
                    /* 'totalresta' => (double)$this->totalrestapagoneg, */
                    'totalresta' => (double)session('totalacumulado')-((double)$this->pagoefectivoven+(double)$this->pagotransfven),
                    'finalizada' => 'NO',
                    'amortizando' => '1'
                ]); //CREA EL DETALLE DE LA CUENTA POR COBRAR
                $datosdetalle = DetalleCuentasPorCobrarVentas::create([
                    'idcpcv' => $datos->id,
                    'fecha'=> date('d-m-Y'),
                    'hora' => date("H:i:s"),
                    'efectivo' => (double)$this->pagoefectivoven,
                    'transferencia' => (double)$this->pagotransfven,
                    'pagado' => (double)$this->pagoefectivoven+(double)$this->pagotransfven,
                    'resta' => (double)session('totalacumulado')-((double)$this->pagoefectivoven+(double)$this->pagotransfven)
                ]);
            }
            $this->mostrar = "false"; $this->mostrarm = "false"; $this->mostrarpagoventa='false';   $this->mostrarbotonpagoventa='false';
            auditar('VENTA #: '.$venta, 'GUARDAR VENTA');
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Venta de Material Realizada!']);
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Se actualizó el Inventário!']);
            session(['totalacumulado' => 0]);
            $this->reset();
        }
    }
    
    public function nuevoabono(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES
        auditar('ABONO', 'GENERAR ABONO');
        $this->mostrar = "true"; $this->mostrarm = "true"; $this->mostrarabono = "true";
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Abono Generado']);
    }

    public function defaultabono(){
        auditar('ABONO', 'CANCELAR ABONO');
        $this->mostrar = "false"; $this->mostrarm = "false"; $this->mostrarabono = "false";
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Abono Cancelado!']);
        $this->reset();
    }
    
    //public $ocultarboton='false';
    public function calrestaven($restaven){ //CALCULA EL RESTO DE LAS COMPRAS
        if((double)$restaven==0){
            $this->validamontotv="NO DEBE";
            $this->totalpagoven=0;
            $this->restapagoven=0;
        }elseif(((double)$this->pagoefectivoven+(double)$this->pagotransfven)>(double)$restaven){
                $this->validamontotv="TOTAL DEBE SER MENOR O IGUAL A: ".(double)$restaven;
                $this->totalpagoven=round((double)$this->pagoefectivoven + (double)$this->pagotransfven,2);
                $this->restapagoven=round((double)$restaven-(double)$this->totalpagoven,2);
                $this->ocultarbotonven="false";
        }else{
            if((is_numeric((double)$this->pagoefectivoven)) or (is_numeric((double)$this->pagotransfven))){
                //$idtipopagoneg, $pagoefectivoven, $pagotransfven, $totalpagoven;
                $this->validamontotv="";
                $this->totalpagoven=round((double)$this->pagoefectivoven + (double)$this->pagotransfven,2);
                $this->restapagoven=round((double)$restaven-(double)$this->totalpagoven,2);
                if($this->idtipopagov==1 and $this->restapagoven==0){ $this->ocultarbotonven="true";
                }elseif($this->idtipopagov==2){ $this->ocultarbotonven="true";
                }else{ $this->ocultarbotonven="false"; }
            }
        }
        //dd($this->restaven);
    }

    public $ocultarboton='false';
    public function calrestaneg($restan){ //CALCULA EL RESTO DE LA NEGOCIACION
        //dd($montotn[0]);
        if((double)$restan==0){
            $this->validamontotn="NO DEBE";
            $this->totalpagoneg=0;
            $this->restapagoneg=0;
        }elseif(((double)$this->pagoefectivoneg+(double)$this->pagotransfneg)>(double)$restan[0]){
                $this->validamontotn="TOTAL DEBE SER MENOR O IGUAL A: ".(double)$restan[0];
                $this->totalpagoneg=round((double)$this->pagoefectivoneg + (double)$this->pagotransfneg,2);
                $this->restapagoneg=round((double)$restan[0]-(double)$this->totalpagoneg,2);
                $this->ocultarboton="false";
        }else{
            if((is_numeric((double)$this->pagoefectivoneg)) or (is_numeric((double)$this->pagotransfneg))){
                //$idtipopagoneg, $pagoefectivoneg, $pagotransfneg, $totalpagoneg;
                $this->validamontotn="";
                $this->totalpagoneg=round((double)$this->pagoefectivoneg + (double)$this->pagotransfneg,2);
                $this->restapagoneg=round((double)$restan[0]-(double)$this->totalpagoneg,2);
                $this->ocultarboton="true";
            }
        }
        if($this->totalpagoneg==0){ $this->ocultarboton="false"; }
    }

    public $pagoefectivoneg, $pagotransfneg, $totalfectivoneg, $totaltransfneg, $totalpagoneg, $totalrestapagoneg, $restapagoneg, $validamontotn, $finalizada, $negociacion_idc; //$mostrarpagoneg='false';
    public function guardaramortizacion(){ //dd($this->negociacion_id);
        $datos = CuentasPorCobrarVentas::find($this->negociacion_idc);
        $this->totalfectivoneg = (double)$datos->totalefectivo+(double)$this->pagoefectivoneg;
        $this->totaltransfneg = (double)$datos->totaltransferencia+(double)$this->pagotransfneg;
        $totalpagado=(double)$datos->totalpagado+(double)$this->pagoefectivoneg+(double)$this->pagotransfneg;
        $datos->update([
            'totalefectivo' => (double)$this->totalfectivoneg,
            'totaltransferencia' => (double)$this->totaltransfneg,
            'totalpagado' => (double)$totalpagado,
            'totalresta' => (double)$this->restapagoneg,
            'amortizando' => '1'
        ]); //detalle_cuentas_por_cobrar_ventas 
        $datosdetalle = DetalleCuentasPorCobrarVentas::create([
            'idcpcv' => $datos->id,
            'fecha'=> date('d-m-Y'),
            'hora' => date("H:i:s"),
            'efectivo' => (double)$this->pagoefectivoneg,
            'transferencia' => (double)$this->pagotransfneg,
            'pagado' => (double)$this->pagoefectivoneg+(double)$this->pagotransfneg,
            'resta' => (double)$this->restapagoneg
        ]); //LA FACTURA SE GENERA DESDE LA BASE DE DATOS CON UN TRIGER $
        /* $this->mostrar = "false"; */ $this->mostrarm = "false"; $this->mostrarpagoneg = 'false';
        $this->ocultarboton='false';
        if($datos->idventa==0){ 
            auditar('VENTA - NEGOCIACION #: '.$datos->idnegociacionventa, 'ABONO A CREDITO');
        }else{ auditar('VENTA - CREDITO #: '.$datos->idventa, 'AMORTIZACION A CREDITO'); }
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => '¡Negociación Actualizada! '.$datos->idnegociacionventa]);
        $this->reset(['totalfectivoneg', 'totaltransfneg', 'restapagoneg', 'pagoefectivoneg', 'pagotransfneg', 'totalpagoneg', 'restapagoneg']);
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
        /* $amortizacionesdepago=ConsultaAmortizacionNegociacionVenta::all(); */
        
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
        }else{ /* $despacho = DespachoMaterial::latest('id')->first(); */
            /* AbonoMaterialNegociacionVentas::create([
                'negociacion_id' => $negociacion_id,
                'idproducton' => $this->idproductov,
                'cantidadpron' => (double)$this->cantidadprov /* 'despachado' => $despacho->id * /
            ]); */
            $datosc = DetalleNegociacionVenta::where('negociacion_id', $this->negociacion_id)
                                ->where('producto_idn', $this->idproductov)->get()->pluck('cantidadprorecmatndebe');
            $debe = (double)$datosc[0]-(double)$this->cantidadprov;
            AbonoMaterialNegociacionVentas::create([
                'negociacion_id' => $negociacion_id,
                'idproducton' => $this->idproductov,
                'cantidadpron' => (double)$this->cantidadprov,
                'debepron' => (double)$debe,
                'iddespacho' => 0
            ]);
            $datosc = DetalleNegociacionVenta::where('negociacion_id', $this->negociacion_id)
                                ->where('producto_idn', $this->idproductov)->get();
            $datosc[0]->update(['cantidadprorecmatndebe' => (double)$debe]);
            $this->cantidadprov="";
            auditar('VENTAS - NEGOCIACION #: '.$this->negociacion_id, 'ABONO DE MATERIAL');
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Material Abonado']);
        }
        }
    }

    public function generardespacho(){ //ABONO DE MATERIALES
        //$this->validate();
        $nc = AbonoMaterialNegociacionVentas::where('negociacion_id',$this->negociacion_id)
                            ->where('iddespacho', 0)->get()->count();
                            /* dd($nc); */
        if($nc==0){ 
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'Agrege Materiales para Generar el Despacho']);
        }else{//GENERAR DESPACHO
            DespachoMaterial::create([
                'fechaventad'=> date('d-m-Y'),
                'horaventad' => date("H:i:s"),
                'cedula' => $this->cedulav,
                'idestatusd' => 1,
                'observaciones' => $this->observacionesv
            ]);
            $despacho = DespachoMaterial::latest('id')->first();
            $productosabonados = AbonoMaterialNegociacionVentas::where('negociacion_id',$this->negociacion_id)->get();
            foreach ($productosabonados->where('iddespacho', 0) as $productoabonado){
                $datosdc = AbonoMaterialNegociacionVentas::where('negociacion_id', $this->negociacion_id)
                    ->where('idproducton', $productoabonado['idproducton']);
                /* if($datosdc->iddespacho==$despacho){ */
                    $datosdc->update(['iddespacho' => $despacho->id, 'despachado' => 'NO']);
                /* }
                dd($datosdc); */
                /* detalle despacho */
                
                DetalleDespacho::create([
                    'iddespacho' => $despacho->id,
                    'idproducto' => $productoabonado['idproducton'],
                    'cantidadpro' => (double)$productoabonado['cantidadpron'],
                    'despachado' => 'NO'
                ]);
                /* detalle despacho */
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
            auditar('VENTAS - NEGOCIACION #: '.$this->negociacion_id, 'ABONAR MATERIAL(ES) Y CREAR ORDEN DE DESPACHO');
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Abono de Material Generado!']);
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Se actualizó el Inventário!']);
            $this->reset(['fechaventa', 'cedulav', 'nombre', 'idlugarv', 'idestatuspagov', 'idtipopagov', 'placav', 'observaciones', 'idventa', 'idproductov', 'cantidadprov', 'precioprov', 'recepcionmaterial_id', 'messages', 'totalacumulado', 'venta']);
        }
    }
}
