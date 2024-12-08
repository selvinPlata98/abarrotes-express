<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@ae.com',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'David',
            'email' => 'triminio@ae.com',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'Luis Angel',
            'email' => 'l_ortez@ae.com',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'Claudia',
            'email' => 'claudia@ae.com',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'Selvin',
            'email' => 's_plata@ae.com',
            'password' => bcrypt('admin'),
        ]);

        User::factory(50)->create();
    }
}
