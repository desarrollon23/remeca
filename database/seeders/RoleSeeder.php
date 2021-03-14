<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        
        //******************PERMISOS DE ALMACEN
        /* Permission::create(['name' => 'livewire.almacen.material-reception.index',
                            'description' =>'Ver la Lista de '])->syncRoles([$role1, $role2, $role4, $role8]);
        Permission::create(['name' => 'livewire.almacen.material-reception.create',
                            'description' =>'Crear un '])->syncRoles([$role1, $role2, $role4, $role8]);
        Permission::create(['name' => 'livewire.almacen.material-reception.edit',
                            'description' =>'Editar un '])->syncRoles([$role1, $role2, $role4, $role8]);
        Permission::create(['name' => 'livewire.almacen.material-reception.destroy',
                            'description' =>'Eliminar un '])->syncRoles([$role1, $role2, $role4, $role8]); */

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
        /* Permission::create(['name' => 'livewire.clientes.index',
                            'description' =>'Ver la Lista de Clientes'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.clientes.create',
                            'description' =>'Crear un Cliente'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.clientes.edit',
                            'description' =>'Editar un Cliente'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.clientes.destroy',
                            'description' =>'Eliminar un Cliente'])->syncRoles([$role1, $role2]); */
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

    }
}
