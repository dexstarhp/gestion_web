<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.register
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShieldSeeder::class);

        // Creamos el usuario
        $superAdmin = User::create([
            'name' => 'Administrador',
            'email' => 'super@admin.com',
            'password' => 'secret',
        ]);

        // Le asignamos el rol de super_admin
        $superAdmin->assignRole('super_admin');
    }
}
