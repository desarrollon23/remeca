<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Sucursal;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //Sucursal::factory(20)->create();
        $this->call(RoleSeeder::class);
        /* $this->call(UserSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(SucursalSeeder::class); */
    }
}
