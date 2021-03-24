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
    public $i = 0, $precio, $preciopro, $totalpro, $toprod;
    public $idestatuspagoc, $idtipopagoc;
    public $datosInventario, $datosc, $datosdc, $nexistencia;
    public $verificaoperacion;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    protected $rules = [
        'cedula' => 'required',
        'idlugar' => 'required',
        'pesofull' => 'required',
        'pesovacio' => 'required',
        'pesoneto' => 'required',
        'pesocalculado' => 'required',
        'producto_id' => 'required',
        'cantidadprorecmat' => 'required'
    ];

    protected $validationattributs = [
        'cedula' => 'Cédula',
        'idlugar' => 'Lugar',
        'pesofull' => 'Peso FULL',
        'pesovacio' => 'Peso VACIO',
        'pesoneto' => 'Peso NETO',
        'producto_id' => 'Material', 
        'cantidadprorecmat' => 'Cantidad de Material',
        'cantidadprorecmat' => 'Cantidad'
    ];

    protected $messages = [
        'cedula.required' => 'Por favor ingrese la Cédula.',
        'cedula.max' => 'La Cédula no puede tener más de 12 caracteres.',
        'idlugar.required' => 'Por favor Seleccione el Lugar.',
        'pesofull.required' => 'Por favor ingrese el Peso FULL.',
        'pesofull.max' => 'El Peso FULL no puede tener más de 8 cifras.',
        'pesovacio.required' => 'Por favor ingrese el Peso VACIO.',
        'pesovacio.max' => 'El Peso VACIO no puede tener más de 8 cifras.',
        'pesoneto.required' => 'Por favor ingrese el Peso NETO.',
        'pesoneto.max' => 'El Peso NETO no puede tener más de 8 cifras.',
        'observaciones.max' => 'Las Observaciones no pueden tener más de 250 caracteres.',
        'cantidadprorecmat.required' => 'Por favor ingrese la Cantidad de Material.',
        'cantidadprorecmat.max' => 'La Cédula no puede tener más de 8 cifras.'
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

    public function caldiferencia($toprodacum){ //CALCULA LA DIFERENCIA DE PAGO
    /* public function caldiferencia(){ //CALCULA LA DIFERENCIA DE PAGO */
        /* if($this->state['totalpagado']<>0){
            if($this->state['totalpagado']>=1){ */
            if(is_numeric($this->state['totalpagado'])){
                $this->state['diferenciapago'] = $toprodacum - (double)$this->state['totalpagado'];
                //$this->state['diferenciapago'] = session('toprodacum') - $this->state['totalpagado'];
            }
            //}else{ $this->state['totalpagado']=0; }
        //}//else{ $this->state['totalpagado']=0; }
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
        /* dd($this->state['totalpagado']);
        if ($this->state['totalpagado']==null) { $this->state['totalpagado']=1; } */
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
            'observacionesc' => " "
            //'observacionesc' => $this->state['observacionesc']
        ]);
        foreach ($productosrecepcion as $productocompra){
            $this->i=$this->i+1;
            $datosdc = DetalleComprador::create([
               'idcompra' => $compra,
               'idproducto' => $productocompra['producto_id'],
               'cantidadpro' => $productocompra['cantidadprorecmat'],
               'operacion' => $productocompra['operacion'],
               'preciopro' => $this->precio, //FALTA QUE GUARDE ESTO
               'totalpro' => $this->toprod //FALTA QUE GUARDE ESTO
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
        $this->reset(['compra', 'cedula', 'nombre', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'observaciones', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', 'fecharecepcion', 'fechacompra', 'fechacomprau', 'idlugar', 'datalcl', 'idestatuspago', 'idtipopago', 'totalcomra', 'totalpagado', 'diferenciapago', 'idestatuspago', 'idtipopago', 'idestatuspagoc', 'idtipopagoc', 'observacionesc', 'datos', 'state', 'nexistencia']);
    }
    
    public function default($compra)    {
        $compra = Compra::findOrFail($compra);
        $compra->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Compra de Material Eliminada!']);
        $this->reset(['compra', 'cedula', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat', "recepcionmaterial_id", 'pesodisponible', 'pesodisponiblec', 'acumulado', 'acumuladoc', ]);
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
