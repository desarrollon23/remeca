<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SucursalComponent; //SE CONVIERTE EN EL COMPONENTE DE PAGINA COMPLETA
//use App\Http\Livewire\Vehiculos; //NO ES COMPONENTE DE PAGINA COMPLETA

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Livewire\Admin\Users\ListUsers;
use App\Http\Livewire\PproveedorComponent;
use App\Http\Livewire\CompradorComponent;
use App\Http\Livewire\ProductosComponent;
use App\Http\Livewire\Almacen;
use App\Http\Livewire\Almacen\MaterialReception;
use App\Http\Livewire\AlmacenComponent;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Livewire\Client;
use App\Http\Controllers\Livewire\PurchaseController;
use App\Http\Controllers\VentaController;
use App\Http\Livewire\DespachoComponent;
use App\Http\Livewire\DetalleNegociacionVenComponent;
use App\Http\Livewire\DetalleNegociacionComComponent;
use App\Http\Livewire\NegociacionComponent;
use App\Http\Livewire\NegociacioncComponent;
use App\Http\Livewire\VentaComponent;
use App\Http\Livewire\VentasComponent;
use App\Http\Livewire\AbonoVentaComponent;
use App\Http\Livewire\ConfiguracionesComponent;
use App\Http\Livewire\DetallematerialcpcComponent;
use App\Http\Livewire\DetallematerialvppComponent;
use App\Http\Livewire\InventarioComponent;
use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', DashBoardController::class)->name('admin.dashboard');

//este controlador se crea con php artisan make:controller Adnim\UserController -r
Route::resource('users', UserController::class)/* ->middleware('can:admin.users') */->names('admin.users');

//este controlador se crea con php artisan make:controller Adnim\RoleController -r
Route::resource('roles', RoleController::class)->except('show')->names('admin.roles'); 

Route::get('contacto', function () {
   $correo = new ContactoMailable; Mail::to('julion23@gmail.com')->send($correo); return 'Mensaje enviado';
});

Route::get('contacto', function () {
    $correo = new ContactoMailable;
    Mail::to('julion23@gmail.com')->send($correo);
    return 'Mensaje enviado';
 })->name('contacto.index');

//Route::resource('purchases', PurchaseController::class)->names('livewire.purchases'); 

//Route::resource('almacen', MaterialReception::class)->except('show')->names('livewire.almacen');


/* Route::resource('livewire/client', Client::class)->names('livewire.client'); */

//LO DE ABAJO EST?? BUENO
/* Route::get('/', function () {return view('welcome');})->name('home'); *

 Route::get('/', function () {
    return view('dashboard');
    //return view('auth.login');
})->name('home');

 Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//Route::get('admin/index', DashBoardController::class);
//Route::get('admin/dashboard', DashBoardController::class)->name('admin.dashboard');
*/

Route::get('livewire/configuraciones', ConfiguracionesComponent::class)->name('livewire.configuraciones');

Route::get('livewire/sucursales', SucursalComponent::class)->name('livewire.sucursales');
//Route::get('livewire/sucursales', SucursalComponent::class)->name('livewire.sucursales');
Route::get('livewire/proveedores', PproveedorComponent::class)->name('livewire.pproveedores');
Route::get('livewire/client', Client::class)->name('livewire.client');

/* Route::get('livewire/compra', CompradorComponent::class)->name('livewire.compra'); */
Route::get('livewire/productos', ProductosComponent::class)->name('livewire.productos');
Route::get('livewire/almacen', AlmacenComponent::class)->name('livewire.almacen');
Route::get('livewire/almacen/material-reception', MaterialReception::class)->name('almacen.material-reception');

Route::get('livewire/almacen/inventario/{material}', [InventarioComponent::class, 'show'])->name('livewire.almacen.inventario');
Route::get('livewire/ventas/materialporpagar/{material}', [DetallematerialvppComponent::class, 'show'])->name('livewire.ventas.materialporpagar');
Route::get('livewire/compras/materialporcobrar/{material}', [DetallematerialcpcComponent::class, 'show'])->name('livewire.compras.materialporcobrar');

Route::put('livewire/almacen/material-reception{material}', [MaterialReception::class, 'updatematerial'])->name('almacen.material-reception.updatematerial');
Route::delete('livewire/almacen/material-reception{material}', [MaterialReception::class, 'destroy'])->name('almacen.material-reception.destroy');
Route::get('livewire/despacho-component', DespachoComponent::class)->name('livewire.despacho-component');

/* livewire.purchases.index
livewire.sales.index
livewire.inventory.index */

Route::get('livewire/comprador-component', CompradorComponent::class)->name('livewire.comprador-component');
Route::get('livewire/purchases/index', CompradorComponent::class)->name('livewire.purchases.index');
Route::get('livewire/purchases/show', CompradorComponent::class)->name('livewire.purchases.show');
Route::put('livewire/purchases/edit', CompradorComponent::class)->name('livewire.purchases.edit');
Route::delete('livewire/purchases/delete', CompradorComponent::class)->name('livewire.purchases.delete');

Route::get('livewire/ventas/negociacion', NegociacionComponent::class)->name('livewire.ventas.negociacion');
Route::get('livewire/compras/negociacion', NegociacioncComponent::class)->name('livewire.compras.negociacion');

Route::get('livewire/ventas/detallenegociacion', [DetalleNegociacionVenComponent::class, 'show'])->name('livewire.ventas.detallenegociacion');

Route::get('livewire/ventas/detallenegociacion/{cedula}', [DetalleNegociacionVenComponent::class, 'show'])->name('livewire.ventas.detallenegociacion');
Route::get('livewire/compras/detallenegociacion/{cedula}', [DetalleNegociacionComComponent::class, 'show'])->name('livewire.compras.detallenegociacion');

Route::get('livewire/{cedula}', [DetalleNegociacionVenComponent::class, 'show'])->name('livewire');

Route::get('livewire/ventas/venta', VentaComponent::class)->name('livewire.ventas.venta');

/* Route::get('livewire/ventas/abono/{id}', [VentaComponent::class, 'show'])->name('livewire.ventas.abono'); */
/* Route::get('livewire/abono-venta-component', AbonoVentaComponent::class)->name('livewire.ventas.abono'); */


Route::get('livewire/ventas/show', VentaComponent::class)->name('livewire.ventas.show');
Route::put('livewire/ventas/edit', VentaComponent::class)->name('livewire.ventas.edit');
Route::delete('livewire/ventas/delete', VentaComponent::class)->name('livewire.ventas.delete');


//Route::get('/', Vehiculos::class); //Para el Componente Full Page, trabaja con la plantilla appCFP.blade.php que debe ser renombrada por app.blade.php

Route::get('admin/users', ListUsers::class)->name('admin.users');