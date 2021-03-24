<?php

namespace App\Http\Controllers\Livewire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compra;

use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\Material;

use App\Models\almacen;
use App\Models\Detallealmacen;
use App\Models\Proveedores;
use App\Models\Sucursal;
use App\Models\Producto;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Cache;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class PurchaseController extends Controller
{
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
    public $close;
    public $vclose;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    public function index()
    {
        return view('livewire.purchases.index');
    }

    public function create()
    {
        return view('livewire.purchases.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Compra $compra)
    {
        return view('livewire.purchases.show', compact('compra'));
    }

    public function edit(Compra $compra)
    {
        return view('livewire.purchases.edit', compact('compra'));
    }

    public function update(Request $request, Compra $compra)
    {
        //
    }

    public function destroy(Compra $compra)
    {
        //
    }
}
