<?php

namespace Database\Factories;

use App\Models\Scooter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScooterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scooter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(30),
            'description' => $this->faker->text(500),
            'point_id' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 1000, 20000)
        ];
    }
}
