<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sucursal::create([
            'descripcion' => 'Maracay',
            'direccion' => 'Maracay. Estado Aragua.',
        ]);
    }
}
