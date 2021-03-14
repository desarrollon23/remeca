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
        User::create([
            'name' => 'Julio H Nuñez A',
            'email' => 'julion23@gmail.com',
            'password' => bcrypt('julion23')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Auditor',
            'email' => 'auditor@remeca.test',
            'password' => bcrypt('auditorremeca')
        ])->assignRole('Auditor');

        User::create([
            'name' => 'Mantenimiento',
            'email' => 'mantenimiento@remeca.test',
            'password' => bcrypt('mantenimiento')
        ])->assignRole('Mantenimiento');

        User::factory(20)->create();
    }
}
