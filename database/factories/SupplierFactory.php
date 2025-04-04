<?php

namespace Database\Factories;

use App\Enums\DocumentType;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'document_number' => $this->faker->unique()->numerify('########'), // Número aleatorio
            'document_type' => $this->faker->randomElement([
                DocumentType::NIT,
                DocumentType::CI,
                DocumentType::OTHER,
            ]), // Asegúrate de tener estos valores en tu enum
            'phone' => $this->faker->phoneNumber(),
            'user_id' => User::factory(), // Relación con un usuario
        ];

    }
}
