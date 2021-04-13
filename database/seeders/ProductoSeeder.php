<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([  //
            'idcate' => '1',
            'descripcion' => 'DESECHO',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'R',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'A',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'P',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'RL',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'RAC',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'ALUM',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'RAL',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'CALAM',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'POTE',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'ACERO',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'PERFIL',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'BATERIA',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'HIERRO P',
            'precio' => 0,
            'cantidad' => 0,
        ]);
        Producto::create([
            'idcate' => '1',
            'descripcion' => 'HIERRO M',
            'precio' => 0,
            'cantidad' => 0,
        ]);
    }
}
