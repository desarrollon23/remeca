<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\Material;
use App\Models\almacen;
use App\Models\Detallealmacen;
use App\Models\Compra;
use App\Models\DetalleComprador;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
//use App\Http\Livewire\Almacen\Request;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Cache;
use App\Http\Livewire\Input;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Http\Livewire\Compras;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CompradorComponent extends Component
{
    public $fecha, $fechacompra, $hora, $cedula, $nombre, $idlugar, $pesofull, $pesovacio, $pesoneto, $observaciones, $almacen_id, $idestatuspago, $idtipopago, $totalcomra, $totalpagado, $diferenciapago, $fecharecepcion, $datos;

    public $recepcion, $recepcionmaterial_id, $producto_id, $cantidadprorecmat, $operacion, $detalmacen_id, $observacionesc;
    public $idproducto;
    public $accion = "store", $acciones = "stores";
    public $productosr;
    public $pesocalculado = 0, $acumulado = 0, $acumuladoc = 0;
    public $numcierre;
    public $accionrecmat;
    public $nopuedeguardar;
    public $pesodisponible = 0, $pesodisponiblec = 0;
    public $close, $vclose;
    public $toprodacum, $diferenciadepago;
    public $compra_id, $compra;
    public $datalcl, $fechacomprau;
    public $i, $precio = [], $preciopro, $totalpro, $toprod = [];
    public $idestatuspagoc, $idtipopagoc;
    public $datosInventario, $datosc, $datosdc, $nexistencia;
    public $verificaoperacion;
    public $cantidadp1, $cantidadp2, $cantidadp3, $cantidadp4, $cantidadp5, $cantidadp6, $cantidadp7, $cantidadp8, $cantidadp9, $cantidadp10;
    public $precio1, $precio2, $precio3, $precio4, $precio5, $precio6, $precio7, $precio8, $precio9, $precio10;
    public $toprod1, $toprod2, $toprod3, $toprod4, $toprod5, $toprod6, $toprod7, $toprod8, $toprod9, $toprod10;
    public $cantpro, $totalcalculado, $sobregiro, $vpeso;
    public $probc, $muesdesmaterial;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $calculos = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    protected $rules = [
        'idestatuspago' => 'required',
        'idtipopago' => 'required',
        'observacionesc' => 'required'
    ];

    protected $validationattributs = [
        'idestatuspago' => 'Estatus de Pago',
        'idtipopago' => 'Tipo de Pago',
        'observacionesc' => 'Observaciones'
    ];

    protected $messages = [
        'idestatuspago.required' => 'Por favor seleccione el Estatus de Pago.',
        'idtipopago.required' => 'Por favor seleccione el Tipo de Pago.',
        'observacionesc.required' => 'Por favor ingrese las Observaciones.',
        'observacionesc.max' => 'Las Observaciones no puede tener más de 250 letras.',
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
            // 'recepcionmaterial_id' => 'required',
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
            if($this->pesofull>=1 or $this->pesovacio>=1){
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
    /* public function calpreind(){
        //$variable[$numero] = "numero".$numero;
        /* if(is_numeric($this->numero.$numero)){ * /
        if(is_numeric($this->precio1)){
            $this->toprod1 = (double)$this->cantidadp1 * (double)$this->precio1;
        }
    } */

    public function calpreind($numero, $cantpro){
        (double)$this->totalcalculado=0;
        if(is_numeric($this->{"precio".$numero})){
            (double)$this->{"toprod".$numero}=(double)$this->{"cantidadp".$numero} * (double)$this->{"precio".$numero};
            for($i=1;$i<=$cantpro;$i++){
                (double)$this->totalcalculado=(double)$this->totalcalculado+$this->{"toprod".$i};
            }
        }
    }
    
    public function caldiferencia(){ //CALCULA LA DIFERENCIA DE PAGO
        (double)$this->state['diferenciapago']=0;
        if(is_numeric($this->state['totalpagado'])){
            //(double)$this->state['diferenciapago'] = (double)$toprodacum - (double)$this->state['totalpagado'];
            (double)$this->state['diferenciapago'] = (double)$this->totalcalculado - (double)$this->state['totalpagado'];
            if((double)$this->state['totalpagado']<=(double)$this->totalcalculado){
                //(double)$this->state['diferenciapago'] = 0;
                $this->vpeso = "false";
                $this->sobregiro=" ";
            }else{
                $this->vpeso = "true";
                $this->sobregiro="NO DEBE PAGAR MAS DEL TOTAL";
            }
        }
    }
    
    public function verificarpeso(){ //CALCULA EL PESO DISPONIBLE
        if($this->pesodisponiblec > $this->state['cantidadprorecmat']){
            $this->close = "true";
            $this->pesodisponiblec = $this->pesodisponible - (double)$this->state['cantidadprorecmat'];
            $this->acumuladoc = $this->acumulado + (double)$this->state['cantidadprorecmat'];
        }else{ 
            $this->close = "false";
            $this->pesodisponiblec=(string)$this->pesodisponible." INSUFICIENTE";
            $this->acumuladoc = $this->acumulado;
        }
    }

    /* public function busproc(){ //BUSCA LOS PROVEEDORES
        $probc=Proveedores::where('cedula',$this->cedula)->get()->pluck('nombre');
        $this->nombre = isset($probc) ? $probc : "NO EXISTE";
    } */
    public function busnumal(){ //BUSCA LOS DATOS DEL ALMACEN
        /* if(isset($recepcionmaterial_id)==0){ */
        $datalm = Almacen::find($this->recepcionmaterial_id);
        //$datalm = Almacen::all()->where('recepcionmaterial_id',$this->recepcionmaterial_id);
        if(isset($datalm)<>null){
        $this->fecha = isset($datalm->fecha) ? $datalm->fecha : "";
        $this->cedula = isset($datalm->cedula) ? $datalm->cedula : "";
        $datalmn=Proveedores::where('cedula',$datalm->cedula)->get()->pluck('nombre');
        $this->nombre = isset($datalmn) ? $datalmn : "";
        $datalml=Sucursal::where('id',$datalm->idlugar)->get()->pluck('descripcion');
        $this->idlugar = isset($datalml) ? $datalml : "";
        $this->pesofull = isset($datalm->pesofull) ? $datalm->pesofull : "";
        $this->pesovacio = isset($datalm->pesovacio) ? $datalm->pesovacio : "";
        $this->pesoneto = isset($datalm->pesoneto) ? $datalm->pesoneto : "";
        $this->pesocalculado = isset($datalm->pesocalculado) ? $datalm->pesocalculado : "";
        $this->observaciones = isset($datalm->observaciones) ? $datalm->observaciones : "";
        }
        /* }else{ $recepcionmaterial_id=""; } */
    }

    public function buspron(){ //BUSCA LOS PROVEEDORES
        $probn=Proveedores::where('nombre',$this->nombre)->get()->pluck('cedula');
        $this->cedula = isset($probn) ? $probn : "";
    }

    public function traedesmaterial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['descripcion'];
        return $this->muesdesmaterial;
    }

    public function traeprematerial($id){
        $probc=Producto::find($id);
        $this->muesdesmaterial=$probc['precio'];
        return $this->muesdesmaterial;
    }

    public function generar(){ //AQUÍ SE GUARDA LA RECEPCION DESPUES SE GUARDAN LOS MATERIALES       
        $nc = Compra::count();
        if($nc==0){ $nc = 1; }else{ ++$nc; }
        $recepcion = Almacen::find($this->recepcionmaterial_id);
        $datosc = Compra::create([
            'id' => $nc,           
            //'fecharecepcion' => $this->fecha,
            'fecharecepcion' => $recepcion->fecha,
            'fechacompra' => $this->fechacompra,
            'hora' => $this->hora,
            //'cedula' => $this->cedula,
            'cedula' => $recepcion->cedula,
            'idlugar' => $recepcion->idlugar,
            'idestatuspago' => $this->idestatuspago,
            'idtipopago' => 1, //'idtipopago' => $this->idtipopago,
            'totalcomra' => 1, //'totalcomra' => $this->totalcomra,
            'totalpagado' => $this->totalpagado,
            'diferenciapago' => $this->diferenciapago,
            'observacionesc' => "Ninguna" //'observacionesc' => $this->observacionesc
        ]);
        $compra = Compra::latest('id')->first();
        $this->compra=$compra->id;
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Compra de Material Generada']);
    }

    public function update($compra, $productosrecepcion, $toprodacum){
        $validateData = Validator::make($this->state, [
            'idestatuspago' => 'required',
            'idtipopago' => 'required',
            'observacionesc' => 'max:250'
        ])->validate();
        $fechacomprau = date('d-m-Y');
        $recepcion = Almacen::find($this->recepcionmaterial_id);
        $datosc = Compra::find($compra);
        $datosc->update([
            'fecharecepcion' => $recepcion->fecha,
            'fechacompra' => $fechacomprau,
            //'hora' => $this->hora,
            'cedula' => $recepcion->cedula,
            'idlugar' => $recepcion->idlugar,
            'idestatuspago' => $this->state['idestatuspago'],
            'idtipopago' => $this->state['idtipopago'],
            'totalcomra' => $toprodacum,
            'totalpagado' => (double)$this->state['totalpagado'],
            'diferenciapago' => $this->state['diferenciapago'],
            'observacionesc' => $this->state['observacionesc']
        ]);
        foreach ($productosrecepcion as $productocompra){
            $this->i=$this->i+1;
            $datosdc = DetalleComprador::create([
               'idcompra' => $compra,
               'idproducto' => $productocompra['producto_id'],
               'cantidadpro' => $productocompra['cantidadprorecmat'],
               'operacion' => $productocompra['operacion'],
               'preciopro' => $this->{"precio".$this->i},
               'totalpro' => $this->{"toprod".$this->i}
            ]);
            //guardar la compra en el inventario
            //buscar la existena del producto en la tabla producto
            $existenciapro=Producto::find($productocompra['producto_id']);
            $datosInventario = Inventario::create([
                'fecha' => $fechacomprau,
                'hora' => date("H:i:s"), //COLOCAR LA HORA DE VENEZUELA
                'idproducto' => $productocompra['producto_id'],
                'comprados' => $productocompra['cantidadprorecmat'],
                'vendidos' => 0,
                'existencia' => $existenciapro->cantidad
            ]);
            //actualizar la existencia en la tabla del producto
            $datospro = Producto::find($productocompra['producto_id']);
            $nexistencia = $existenciapro->cantidad+$productocompra['cantidadprorecmat'];
            $datospro->update([
                'cantidad' => $nexistencia
            ]);
        }
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Compra de Material Realizada!']);
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Se actualizó el Inventário!']);
        $this->reset(['compra', 'cedula', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'observaciones', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', 'fecharecepcion', 'fechacompra', 'fechacomprau', 'idlugar', 'datalcl', 'idestatuspago', 'idtipopago', 'totalcomra', 'totalpagado', 'diferenciapago', 'idestatuspago', 'idtipopago', 'idestatuspagoc', 'idtipopagoc', 'observacionesc', 'datos', 'state', 'nexistencia', 'diferenciapago', 'totalpagado', 'totalcalculado', 'acumulado']);
    }
    
    public function default($compra)    {
        $compra = Compra::findOrFail($compra);
        $compra->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Compra de Material Eliminada!']);
        $this->reset(['compra', 'cedula', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'obsercaciones', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', ]);
    }

    public function show(){
        $compras = Compra::all();
        return view('livewire.purchases.show', compact('compras'));
    }

    public function render()
    {
            /* $existenciapro=Producto::find(1);
            dd($existenciapro->cantidad); */
            $vendedores = Proveedores::all();
            $lugares = Sucursal::all();
            $productos = Producto::all();
            //$recepcion = Almacen::latest('id')->first(); //AQUÍ SE COLOCA EL ID DEL ALMACEN
            $recepcion = Almacen::all();
            $materiales = Material::all();
            $este=$this->recepcion;
            $productosrecepcion=Detallealmacen::all()->where('recepcionmaterial_id', 
            $this->recepcionmaterial_id);
            return view('livewire.comprador-component', [
                        'materiales'=>$materiales,
                ], compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion'));
    }
}




/* namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Compra;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;

class CompradorComponent extends Component
{
    public $cedula, $compra_id;
    //public $clientes;
    public $accion = "store";
    protected $rules = [
        'cedula' => 'required'
    ];

    protected $validationattributs = [
        'cedula' => 'Cédula'
    ];

    protected $messages = [
        'cedula.required' => 'Por favor ingrese la Cédula o Rif.',
        'cedula.max' => 'La Cédula no puede tener más de 15 caracteres.',
        'cedula.min' => 'La Cédula no puede tener menos de 10 caracteres.',
    ];

    public function render()    {
        $compradores = Compra::all();
        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        return view('livewire.comprador-component', compact('compradores', 'vendedores', 'lugares', 'productos'));
    }

    public function store()    {
        $this->validate([
            'cedula' => 'required|min:10|max:15',
        ]);
        Compra::create([
            'cedula' => $this->cedula,
            'idlugar' => $this->idlugar,
        ]);
        $this->reset(['cedula']);
    }

    public function edit(Compra $Compra)    {
        $this->cedula = $Compra->cedula;
        $this->idlugar = $Compra->idlugar;
        $this->compra_id = $Compra->id;
        $this->accion = "update";
    }

    public function update()    {
        $this->validate();
        $Compra = Compra::find($this->compra_id);
        $Compra->update([
            'cedula' => $this->cedula,
            'idlugar' => $this->idlugar
        ]);
        $this->reset(['cedula', 'idlugar', 'accion', 'compra_id']);
    }

    public function destroy(Compra $Compra)    {
        $Compra->delete();
        $this->reset(['cedula', 'idlugar']);
        $this->reset(['cedula', 'idlugar', 'accion', 'compra_id']);
    }
    
    public function default()    {
        $this->reset(['cedula', 'idlugar', 'accion', 'compra_id']);
    }
} */
