<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret')
        ]);
        $this->call(AssignRolesSeeder::class);

        // Crear usuarios de prueba
        User::factory()->count(5)->create();

        // Crear proveedores, clientes y productos
        Supplier::factory()->count(10)->create();
        Customer::factory()->count(15)->create();
        Product::factory()->count(12)->create();
    }
}
