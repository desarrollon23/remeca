<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//use Illuminate\Database\Eloquent\Model; //saltarnos las protecciones ESTO SE DEBE ELIMINAR
//use App\Book;                           //saltarnos las protecciones ESTO SE DEBE ELIMINAR

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();   //saltarnos las protecciones ESTO SE DEBE ELIMINAR
        
        //ROLES
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Auditor']);
        $role3 = Role::create(['name' => 'Mantenimiento']);
        $role4 = Role::create(['name' => 'Presidencia']);
        $role5 = Role::create(['name' => 'Finanzas']);
        $role6 = Role::create(['name' => 'Logistica']);
        $role7 = Role::create(['name' => 'Administracion']);
        $role8 = Role::create(['name' => 'Almacen']);

        //PERMISOS
        //$permission = Permission::create(['name' => 'admin.dashboard']);
        /* Permission::create(['name' => 'home'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6, $role7, $role8]); */
        Permission::create(['name' => 'admin.dashboard',
                            'description' =>'Ver la Página Principal'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6, $role7, $role8]);

        //******************PERMISOS DE FINANZAS
        /* Permission::create(['name' => 'livewire.purchases.index',
                            'description' =>'Ver la Lista de Compras'])->syncRoles([$role1, $role2, $role4, $role5]); */  //TAMBIEN ES PARA ADMINISTRACION
        
        Permission::create(['name' => 'livewire.inventory.index',
                            'description' =>'Ver el Inventario'])->syncRoles([$role1, $role2, $role4, $role5, $role7]);
        /* Permission::create(['name' => 'livewire.almacen.material-reception.destroy',
                            'description' =>'Eliminar una Compra'])->syncRoles([$role1, $role2, $role4, $role5]); */
                            
        //******************PERMISOS DE LOGISTICA
        Permission::create(['name' => 'livewire.configuraciones',
                            'description' =>'Establecer Configuraciones'])->syncRoles([$role1, $role2, $role4, $role6]);

        //******************PERMISOS DE ADMINISTRACION
        Permission::create(['name' => 'livewire.purchases.index',
                            'description' =>'Ver la Lista de Compras'])->syncRoles([$role1, $role2, $role4, $role5, $role7]); //TAMBIEN ES PARA FINANZAS
        Permission::create(['name' => 'livewire.comprador-component',
                            'description' =>'Crear una Compra'])->syncRoles([$role1, $role2, $role4, $role7]);
        Permission::create(['name' => 'livewire.purchases.edit',
                            'description' =>'Editar una Compra'])->syncRoles([$role1, $role2, $role4, $role7]);
        Permission::create(['name' => 'livewire.purchases.destroy',
                            'description' =>'Eliminar una Compra'])->syncRoles([$role1, $role2, $role4, $role7]);
                //**********PERMISOS DE VENTAS */
        Permission::create(['name' => 'livewire.livewire.ventas-component',
                            'description' =>'Ver la Negociacion de Ventas'])->syncRoles([$role1, $role2, $role4, $role5, $role7]);
        Permission::create(['name' => 'livewire.ventas.index',
                            'description' =>'Ver la Lista de Ventas'])->syncRoles([$role1, $role2, $role4, $role5, $role7]);
        Permission::create(['name' => 'livewire.ventas.show',
                            'description' =>'Crear una Venta'])->syncRoles([$role1, $role2, $role4, $role7]);
        Permission::create(['name' => 'livewire.ventas.edit',
                            'description' =>'Editar una Venta'])->syncRoles([$role1, $role2, $role4, $role7]);
        Permission::create(['name' => 'livewire.ventas.destroy',
                            'description' =>'Eliminar una Venta'])->syncRoles([$role1, $role2, $role4, $role7]);

        //******************PERMISOS DE ALMACEN
        Permission::create(['name' => 'livewire.almacen.material-reception.index',
                            'description' =>'Ver la Lista de Recepcion de Materiales'])->syncRoles([$role1, $role2, $role4, $role8]);
        Permission::create(['name' => 'livewire.almacen.material-reception.create',
                            'description' =>'Crear una Recepcion de Materiales'])->syncRoles([$role1, $role2, $role4, $role8]);
        Permission::create(['name' => 'livewire.almacen.material-reception.edit',
                            'description' =>'Editar una Recepcion de Materiales'])->syncRoles([$role1, $role2, $role4, $role8]);
        Permission::create(['name' => 'livewire.almacen.material-reception.destroy',
                            'description' =>'Eliminar una Recepcion de Materiales'])->syncRoles([$role1, $role2, $role4, $role8]);

        //******************PERMISOS DE MANTENIMIENTOS
        //PROVEEDORES
        Permission::create(['name' => 'livewire.pproveedores.index',
                            'description' =>'Ver la Lista de Proveedores'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.pproveedores.create',
                            'description' =>'Crear un Proveedor'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.pproveedores.edit',
                            'description' =>'Editar un Proveedor'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.pproveedores.destroy',
                            'description' =>'Eliminar un Proveedor'])->syncRoles([$role1, $role2]);
        //CLIENTES
        Permission::create(['name' => 'livewire.clientes.index',
                            'description' =>'Ver la Lista de Clientes'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.clientes.create',
                            'description' =>'Crear un Cliente'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.clientes.edit',
                            'description' =>'Editar un Cliente'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.clientes.destroy',
                            'description' =>'Eliminar un Cliente'])->syncRoles([$role1, $role2]);
        //PRODUCTOS
        Permission::create(['name' => 'livewire.productos.index',
                            'description' =>'Ver la Lista de Materiales'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.productos.create',
                            'description' =>'Crear un Material'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.productos.edit',
                            'description' =>'Editar un Material'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.productos.destroy',
                            'description' =>'Eliminar un Material'])->syncRoles([$role1, $role2]);
        //SUCURSALES
        Permission::create(['name' => 'livewire.sucursales.index',
                            'description' =>'Ver la Lista de Lugares'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.sucursales.create',
                            'description' =>'Crear un Lugar'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.sucursales.edit',
                            'description' =>'Editar un Lugar'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.sucursales.destroy',
                            'description' =>'Eliminar un Lugar'])->syncRoles([$role1, $role2]);
        //VEHICULOS
        /* Permission::create(['name' => 'livewire.productos.index',
                            'description' =>'Ver la Lista de Vehículos'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.productos.create',
                            'description' =>'Crear un Vehículo'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.productos.edit',
                            'description' =>'Editar un Vehículo'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.productos.destroy',
                            'description' =>'Eliminar un Vehículo'])->syncRoles([$role1, $role2]); */
        //USUARIOS
        Permission::create(['name' => 'admin.users.index',
                            'description' =>'Ver la Lista de Usuarios'])->syncRoles([$role1, $role2, $role3]);
        /* Permission::create(['name' => 'admin.users.create',
                            'description' =>'Crear un Usuario'])->syncRoles([$role1, $role2, $role3]); */
        Permission::create(['name' => 'admin.users.edit',
                            'description' =>'Editar un Usuario'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.users.update',
                            'description' =>'Eliminar un Usuario'])->syncRoles([$role1, $role2, $role3]);
        //ROLES
        Permission::create(['name' => 'admin.roles.index',
                            'description' =>'Ver la Lista de Roles'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.roles.create',
                            'description' =>'Crear un Rol'])->syncRoles([$role1, $role2], $role3);
        Permission::create(['name' => 'admin.roles.edit',
                            'description' =>'Editar un Rol'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.roles.destroy',
                            'description' =>'Eliminar un Rol'])->syncRoles([$role1, $role2, $role3]);

    }
}
