<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([              //ADMINISTRADOR
            'name' => 'Julio H Nuñez A',
            'email' => 'julion23@gmail.com',
            'password' => bcrypt('julion23')
        ])->assignRole('Admin');

        User::create([              //AUDITORIA
            'name' => 'Auditor',
            'email' => 'auditor@remeca.test',
            'password' => bcrypt('auditorremeca')
        ])->assignRole('Auditor');

        User::create([              //MANTENIMIENTO
            'name' => 'Mantenimiento',
            'email' => 'mantenimiento@remeca.test',
            'password' => bcrypt('mantenimiento')
        ])->assignRole('Mantenimiento');

        User::create([              //PRESIDENCIA
            'name' => 'Sr Miguel',
            'email' => 'miguel@remeca.test',
            'password' => bcrypt('presidencia')
        ])->assignRole('Presidencia');

        User::create([              //FINANZAS
            'name' => 'Sra Gusmary',
            'email' => 'gusmary@remeca.test',
            'password' => bcrypt('finanzas')
        ])->assignRole('Finanzas');

        User::create([              //LOGISTICA
            'name' => 'Sra Erika',
            'email' => 'erika@remeca.test',
            'password' => bcrypt('logistica')
        ])->assignRole('Logistica');

        User::create([              //ADMINISTRACION
            'name' => 'Sra Katherine',
            'email' => 'katherine@remeca.test',
            'password' => bcrypt('administracion')
        ])->assignRole('Administracion');

        User::create([              //ALMACEN
            'name' => 'Almacen',
            'email' => 'almacen@remeca.test',
            'password' => bcrypt('almacen1')
        ])->assignRole('Almacen');

        User::factory(20)->create();
    }
}
