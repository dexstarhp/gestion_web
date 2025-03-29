<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear rol 'admin' si no existe
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Asignar el rol 'admin' al usuario con ID 1
        $user = User::find(1); // Encuentra al usuario con ID 1
        if ($user) {
            $user->assignRole('admin'); // Asigna el rol 'admin' al usuario
        }
    }
}
