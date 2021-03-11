<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\almacen;
use App\Models\Detallealmacen;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class AlmacenComponent extends Component
{
    public $cedula, $idlugar, $pesofull, $pesovacio, $pesoneto, $observaciones, $almacen_id;
    public $recepcion, $recepcionmaterial_id, $producto_id, $cantidadprorecmat, $detalmacen_id;
    public $accion = "store";
    public $acciones = "stores";
    public $productosr;
    public $pesocalculado = 0;
    public $acumulado = 0;

    protected $rules = [
        'cedula' => 'required', 'idlugar' => 'required',
        'pesofull' => 'required', 'pesovacio' => 'required',
        'pesoneto' => 'required', 'pesocalculado' => 'required',
        'producto_id' => 'required', 'cantidadprorecmat' => 'required'
    ];

    protected $validationattributs = [
        'cedula' => 'Cédula', 'idlugar' => 'Lugar',
        'pesofull' => 'Peso FULL', 'pesovacio' => 'Peso VACIO',
        'pesoneto' => 'Peso NETO',
        'producto_id' => 'Material', 'cantidadprorecmat' => 'Cantidad de Material'
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
        'cantidadprorecmat.max' => 'La Cédula no puede tener más de 8 cifras.',
    ];

    public function render(){
        /* $productosr = ['producto_id', 'cantidadprorecmat'];
        $collection = collect($productosr);
        $collection->all(); */

        $vendedores = Proveedores::all();
        $lugares = Sucursal::all();
        $productos = Producto::all();
        $recepcion = Almacen::latest('id')->first();
        $productosrecepcion=Detallealmacen::all();

        /* if($recepcion!=0){
            //$productosrecepcion=Detallealmacen::where('recepcionmaterial_id',$recepcion)->get();
            $productosrecepcion=Detallealmacen::join('detallerecmat', 'detallerecmat.producto_id', '=', '_pproductos.id')->where('detallerecmat.id', '=', $recepcion)->get(['detallerecmat.*','_pproductos.descripcion']);

            return view('livewire.almacen-component', compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion'));
        } */
        return view('livewire.almacen-component', compact('vendedores', 'lugares', 'productos', 'recepcion', 'productosrecepcion'));
    }

    public $nummat=0;
    public $materiales = [], $materialeid = [], $materialede = [];
    public function suma(){
        //dd($this->accion.' ' .$this->producto_id.' ' .$this->cantidadprorecmat);
/*             $this->validate([
                'producto_id' => 'required', 'cantidadprorecmat' => 'required|max:8'
        ]); */
        $this->acumulado = $this->acumulado + $this->cantidadprorecmat;
        //dd($this->acumulado);
        $this->nummat++;
        $this->producto_des = Producto::find($this->producto_id)->get('descripcion');
        //dd($this->producto_des);
        array_push($this->materiales, [$this->producto_id, $this->producto_des]);
        /* array_push($this->materialede, $this->producto_des);
        array_push($this->materiales, $this->materialeid, $this->materialede); */
        $this->reset('producto_id');
        /* $this->reset(['producto_id', 'cantidadprorecmat']);
        $this->reset('producto_id');
        $this->reset('cantidadprorecmat'); */

        /*Almacen::create([
            'fecha' => $this->fecha, 
            'pesocalculado' => $this->pesocalculado, ]);
        Detallealmacen::create([
            'recepcionmaterial_id' => $this->recepcionmaterial_id,
            'producto_id' => $this->producto_id,
            'cantidadprorecmat' => $this->cantidadprorecmat
        ]);
        / * }
        if($this->accion=="GUARDAR"){
            $this->validate([
                'cedula' => 'required|max:12', 'idlugar' => 'required',
                'pesofull' => 'required|max:8', 'pesovacio' => 'required|max:8',
                'pesoneto' => 'required|max:8', 'observaciones' => 'required|max:250'
            ]);
            Almacen::create([
                'fecha' => $this->fecha, 'cedula' => $this->cedula,
                'idlugar' => $this->idlugar, 'pesofull' => $this->pesofull,
                'pesovacio' => $this->pesovacio, 'pesoneto' => $this->pesoneto,
                'pesocalculado' => $this->pesocalculado,'observaciones' => $this->observaciones
                /* ,'recibido' = 'SI' * /
            ]);
        } */
        $this->reset(['producto_id', 'cantidadprorecmat']);
    }

    public function edit(Almacen $producto)    {
        $this->producto_id = $producto->producto_id;
        $this->cantidadprorecmat = $producto->cantidadprorecmat;
        $this->recepcionmaterial_id = $producto->recepcionmaterial_id;
        $this->accion = "update";
    }

    public function update()    {
        $this->validate();
        $producto = Producto::find($this->recepcionmaterial_id);
        $producto->update([
            'producto_id' => $this->recepcionmaterial_id,
            'cantidadprorecmat' => $this->cantidadprorecmat
        ]);
        $this->reset(['cedula', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat']);
    }

    public function destroy(Almacen $producto)    {
        $producto->delete();
        $this->reset(['cedula', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat']);
    }
    
    public function default()    {
        $this->reset(['cedula', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'almacen_id', 'producto_id', 'cantidadprorecmat']);
    }

    public function agregarp($accion, $producto_id, $cantidadprorecmat, $pesocalculado) {
        
        if($accion=='SUMA' | $accion=='RESTA'){
            /* $this->validate([
                'producto_id' => 'required', 'cantidadprorecmat' => 'required|max:8'
            ]); */
            if($accion=='SUMA'){
                $pesocalculado = $pesocalculado + $cantidadprorecmat;
            }
            if($accion=='RESTA'){
                $pesocalculado = $pesocalculado - $cantidadprorecmat;
            }
            /* $productosr = ['producto_id' => $producto_id, 'cantidadprorecmat' => $cantidadprorecmat]; */
            //$productosr = array('producto_id', 'cantidadprorecmat');
            //$productosr = array_add($productosr, 'producto_id', $cantidadprorecmat);
            $productosr = Arr::accessible(['producto_id' => $producto_id, 'cantidadprorecmat' => $cantidadprorecmat]);
            /* $collection = collect($productosr);
            $collection->all(); */
            return $productosr;
        }
    }
}