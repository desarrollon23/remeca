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

//LO DE ABAJO ESTÁ BUENO
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
Route::get('livewire/sucursales', SucursalComponent::class)->name('livewire.sucursales');
//Route::get('livewire/sucursales', SucursalComponent::class)->name('livewire.sucursales');
Route::get('livewire/proveedores', PproveedorComponent::class)->name('livewire.pproveedores');
Route::get('livewire/compra', CompradorComponent::class)->name('livewire.compra');
Route::get('livewire/productos', ProductosComponent::class)->name('livewire.productos');
Route::get('livewire/almacen', AlmacenComponent::class)->name('livewire.almacen');
Route::get('livewire/almacen/material-reception', MaterialReception::class)->name('almacen.material-reception');

//Route::get('/', Vehiculos::class); //Para el Componente Full Page, trabaja con la plantilla appCFP.blade.php que debe ser renombrada por app.blade.php

Route::get('admin/users', ListUsers::class)->name('admin.users');