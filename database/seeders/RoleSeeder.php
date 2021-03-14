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
        Permission::create(['name' => 'admin.dashboard'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6, $role7, $role8]);

        //******************PERMISOS DE MANTENIMIENTOS
        //PROVEEDORES
        Permission::create(['name' => 'livewire.pproveedores.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.pproveedores.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.pproveedores.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.pproveedores.destroy'])->syncRoles([$role1, $role2]);
        //CLIENTES
        /* Permission::create(['name' => 'livewire.clientes.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.clientes.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.clientes.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.clientes.destroy'])->syncRoles([$role1, $role2]); */
        //PRODUCTOS
        Permission::create(['name' => 'livewire.productos.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.productos.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.productos.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.productos.destroy'])->syncRoles([$role1, $role2]);
        //SUCURSALES
        Permission::create(['name' => 'livewire.sucursales.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.sucursales.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.sucursales.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.sucursales.destroy'])->syncRoles([$role1, $role2]);
        //VEHICULOS
        /* Permission::create(['name' => 'livewire.productos.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.productos.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.productos.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'livewire.productos.destroy'])->syncRoles([$role1, $role2]); */
        //USUARIOS
        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1, $role2, $role3]);
        /* Permission::create(['name' => 'admin.users.create'])->syncRoles([$role1, $role2, $role3]); */
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$role1, $role2, $role3]);

        //******************PERMISOS DE ALMACEN
        Permission::create(['name' => 'livewire.almacen.material-reception.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'livewire.almacen.material-reception.create'])->syncRoles([$role1, $role2, $role8]);
        Permission::create(['name' => 'livewire.almacen.material-reception.edit'])->syncRoles([$role1, $role2, $role8]);
        Permission::create(['name' => 'livewire.almacen.material-reception.destroy'])->syncRoles([$role1, $role2, $role8]);

        

    }
}
