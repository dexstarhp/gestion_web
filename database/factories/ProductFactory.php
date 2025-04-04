<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * The name of the factory's corresponding model.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isService = $this->faker->boolean(30); // 30% chance de que sea un servicio
        return [
            'name' => $isService
                ? $this->faker->randomElement([
                    'Servicio de entierro', 'Uso de salón velatorio', 'Traslado funerario', 'Ceremonia religiosa'
                ]) . ' #' . $this->faker->unique()->numberBetween(1, 10000)
                : $this->faker->randomElement([
                    'Ataúd estándar', 'Urna de cerámica', 'Cruz de madera', 'Flores decorativas'
                ]) . ' #' . $this->faker->unique()->numberBetween(1, 10000),
            'description' => $this->faker->sentence(),
            'is_service' => $isService,
            'image_url' => $this->faker->imageUrl(640, 480, 'funeral', true),
            'user_id' => User::factory(), // Relación con el usuario creador
        ];
    }
}
