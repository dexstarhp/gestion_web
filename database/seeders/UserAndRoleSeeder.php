<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $superRole = Role::firstOrCreate(['name' => 'super-user']);
        $vendedorRole = Role::firstOrCreate(['name' => 'vendedor']);
        $compradorRole = Role::firstOrCreate(['name' => 'comprador']);

        // Si usás Filament Shield y ya generaste los permisos
        if (Permission::count() > 0) {
            $superRole->syncPermissions(Permission::all()); // acceso total
        }

        // Crear usuarios y asignar roles
        $super = User::firstOrCreate(
            ['email' => 'super@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => 'password',
            ]
        );
        $super->assignRole($superRole);

        $vendedor = User::firstOrCreate(
            ['email' => 'vendedor@tienda.com'],
            [
                'name' => 'Vendedor',
                'password' => 'password',
            ]
        );
        $vendedor->assignRole($vendedorRole);

        $comprador = User::firstOrCreate(
            ['email' => 'comprador@tienda.com'],
            [
                'name' => 'Comprador',
                'password' => 'password',
            ]
        );
        $comprador->assignRole($compradorRole);
    }
}
