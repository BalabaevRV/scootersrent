<?php

namespace Database\Factories;

use App\Models\Rent;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1, 20),
            'manager_id' => $this->faker->numberBetween(1, 15),
            'point_id' => $this->faker->numberBetween(1, 10),
            'scooter_id' => $this->faker->numberBetween(1, 50),
            'amount' => $this->faker->randomFloat(2, 1000, 20000),
            'document' => $this->faker->text(500),
            'status' => $this->faker->numberBetween(0, 2),
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime()
        ];
    }
}
