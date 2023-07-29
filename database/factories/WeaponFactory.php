<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Weapon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weapon>
 */
class WeaponFactory extends Factory
{
    protected $model = Weapon::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'type_id' => fake()->numberBetween(1, 6)
        ];
    }
}
