<?php

namespace App\Http\Livewire;

use App\Models\PrecioProducto;
use App\Models\PreciosProductosProvClie;
use Livewire\Component;
use App\Models\Proveedores;
use App\Models\Producto;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Request;

class PproveedorComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $cedula, $nombre, $direccion, $telefono, $correo, $pproveedor_id, $visible;
    public $accion = "store";

    public $p, $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10,
    $p11, $p12, $p13, $p14, $p15, $p16, $p17, $p18, $p19, $p20,
    $p21, $p22, $p23, $p24, $p25, $p26, $p27, $p28, $p29, $p30,
    $p31, $p32, $p33, $p34, $p35, $p36, $p37, $p38, $p39, $p40,
    $p41, $p42, $p43, $p44, $p45, $p46, $p47, $p48, $p49, $p50;

    public $buscarproveedor;

    public function boot(){
        Paginator::useBootstrap();
    }

    protected $rules = [
        'cedula' => 'required|max:12',
        'nombre' => 'required|max:100',
        'direccion' => 'required|max:250',
        'telefono' => 'required|max:30',
        'correo' => 'required|email|max:100',
    ];

    protected $validationattributs = [
        'cedula' => 'Cédula',
        'nombre' => 'Nombre',
        'direccion' => 'Dirección',
        'telefono' => 'Teléfono',
        'correo' => 'Correo',
    ];

    protected $messages = [
        'cedula.required' => 'Por favor ingrese la Cédula o Rif.',
        'cedula.unique' => 'La Cédula o Rif ya existe, por favor ingrese otra.',
        'cedula.max' => 'La Cédula o Rif no puede tener más de 15 caracteres.',
        /* 'cedula.unique' => 'La Cédula o Rif ya exixte.', */
        'nombre.required' => 'Por favor ingrese el Nombre.',
        'nombre.max' => 'El Nombre no puede tener más de 100 caracteres.',
        'direccion.required' => 'Por favor ingrese la Dirección.',
        'direccion.max' => 'La Dirección no puede tener más de 250 caracteres.',
        'telefono.required' => 'Por favor ingrese el Teléfono.',
        'telefono.max' => 'El Teléfono no puede tener más de 30 caracteres.',
        'correo.required' => 'Por favor ingrese el correo.',
        'correo.max' => 'Ingrese un Correo con el siguiente formato nombre@dominio.com.'
    ];

    public function render(){
        $pproveedores = Proveedores::where('cedula', 'like', '%'.$this->buscarproveedor.'%')
                        ->orwhere('nombre', 'like', '%'.$this->buscarproveedor.'%')->get();
        $productos = Producto::all();
        /* $precios = PreciosProveedores::where('cedula', $pproveedores->cedula)->get(); */
        return view('livewire.pproveedor-component', compact('pproveedores', 'productos'));
    }
    
    public $mostrartraerprecios="false"; public $bloqueado="false";
    public function store(){
        $this->validate([
            'cedula' => 'required|unique:proveedores|max:15',
            'nombre' => 'required|max:100',
            'direccion' => 'required|max:250',
            'telefono' => 'required|max:30',
            'correo' => 'required|email|max:100',
        ]);
        Proveedores::create([
            'cedula' => $this->cedula,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'correo' => $this->correo
        ]);
        $this->mostrartraerprecios="true"; $this->bloqueado="true";
        $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'PROVEEDOR CREADO, INGRESE LOS PRECIOS']);
        auditar('MANTENIMIENTOS - CREAR PROVEEDOR - DATOS: '.
            ' Cedula: '.$this->cedula.
            ' Nombre: '.$this->nombre.
            ' Direccion: '.$this->direccion.
            ' Telefono: '.$this->telefono.
            ' Correo: '.$this->correo, 'CREADO');
    }

    public function crearprecios(){
        $cantidad=Producto::count(); $totalno=1;
        for ($i=2; $i <= $cantidad; $i++) {    
            if($this->{"p".$i}==""){ $totalno--;
            }elseif($this->{"p".$i}>0){ $totalno++; }
        }
        if($totalno==$cantidad){
            for ($i=2; $i <= Producto::count(); $i++) {
                $cp = PrecioProducto::where('cedula', $this->cedula)->where('idproducto', $i)->count();
                if($cp!=0){
                    $idp = PrecioProducto::where('cedula', $this->cedula)->where('idproducto', $i)->get()->pluck('id')[0];
                    $np = PrecioProducto::find($idp);
                    $np->update(['precio' => round((double)$this->{"p".$i}, 2)]);
                }else{
                    PrecioProducto::create([
                        'cedula' => $this->cedula,
                        'idproducto' => $i,
                        'precio' => round((double)$this->{"p".$i}, 2) ]);
                }
            }
            $idp = Proveedores::where('cedula', $this->cedula)->get()->pluck('id')[0];
            $this->mostrartraerprecios="true"; $this->bloqueado="false";
            auditar('MANTENIMIENTOS - PROVEEDOR #: '.$idp, 'PRECIOS CREADOS');
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'LOS PRECIOS SE HAN CREADO']);
            $this->reset(['cedula', 'nombre', 'direccion', 'telefono', 'correo', 'accion', 'pproveedor_id','mostrartraerprecios', 'bloqueado', 'p', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16', 'p17', 'p18', 'p19', 'p20', 'p21', 'p22', 'p23', 'p24', 'p25', 'p26', 'p27', 'p28', 'p29', 'p30', 'p31', 'p32', 'p33', 'p34', 'p35', 'p36', 'p37', 'p38', 'p39', 'p40', 'p41', 'p42', 'p43', 'p44', 'p45', 'p46', 'p47', 'p48', 'p49', 'p50']);
        }else{
            $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'DEBE AGREGAR TODOS LOS PRECIOS']);
        }
    }

    public function edit(Proveedores $pproveedor)    {
        $this->cedula = $pproveedor->cedula;
        $this->nombre = $pproveedor->nombre;
        $this->direccion = $pproveedor->direccion;
        $this->telefono = $pproveedor->telefono;
        $this->correo = $pproveedor->correo;
        $this->visible = 'SI';
        $this->pproveedor_id = $pproveedor->id;
        $this->accion = "update";
        auditar('MANTENIMIENTOS - PROVEEDOR #: '.$pproveedor->id.' EDITAR DATOS ACTUALES: '.
            ' Cedula: '.$pproveedor->cedula.
            ' Nombre: '.$pproveedor->nombre.
            ' Direccion: '.$pproveedor->direccion.
            ' Telefono: '.$pproveedor->telefono.
            ' correo: '.$pproveedor->correo, 'EDITAR');
    }

    public function update()    {
        $this->validate();
        $pproveedor = Proveedores::find($this->pproveedor_id);
        $pproveedor->update([
            'cedula' => $this->cedula,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            $this->visible = 'SI'
        ]);
        auditar('MANTENIMIENTOS - PROVEEDOR #: '.$pproveedor->id.' NUEVOS DATOS: '.
            ' Cedula: '.$this->cedula.
            ' Nombre: '.$this->nombre.
            ' Direccion: '.$this->direccion.
            ' Telefono: '.$this->telefono.
            ' Correo: '.$this->correo, 'GUARDAR');
        $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'PROVEEDOR MODIFICADO']);
        $this->reset(['cedula', 'nombre', 'direccion', 'telefono', 'correo', 'accion', 'pproveedor_id']);
    }

    public function destroy(Proveedores $pproveedor)    {
        $pproveedor->delete();
        auditar('PROVEEDOR #: '.$pproveedor->id, 'ELIMINAR');
        $this->dispatchBrowserEvent('busnumalmacen', ['message' => 'PROVEEDOR ELIMINADO']);
        $this->reset(['cedula', 'nombre','direccion', 'telefono', 'correo', 'accion', 'pproveedor_id',
        'mostrartraerprecios', 'bloqueado', 'p', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16', 'p17', 'p18', 'p19', 'p20', 'p21', 'p22', 'p23', 'p24', 'p25', 'p26', 'p27', 'p28', 'p29', 'p30', 'p31', 'p32', 'p33', 'p34', 'p35', 'p36', 'p37', 'p38', 'p39', 'p40', 'p41', 'p42', 'p43', 'p44', 'p45', 'p46', 'p47', 'p48', 'p49', 'p50']);
    }
    
    public function default()    {
        auditar('MANTENIMIENTOS - PROVEEDOR', 'CANCELAR');
        $this->reset(['cedula', 'nombre', 'direccion', 'telefono', 'correo', 'accion', 'pproveedor_id',
        'mostrartraerprecios', 'bloqueado', 'p', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16', 'p17', 'p18', 'p19', 'p20', 'p21', 'p22', 'p23', 'p24', 'p25', 'p26', 'p27', 'p28', 'p29', 'p30', 'p31', 'p32', 'p33', 'p34', 'p35', 'p36', 'p37', 'p38', 'p39', 'p40', 'p41', 'p42', 'p43', 'p44', 'p45', 'p46', 'p47', 'p48', 'p49', 'p50']);
    }
}
