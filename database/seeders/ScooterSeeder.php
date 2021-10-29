<?php

namespace Database\Seeders;

use App\Models\Scooter;
use Illuminate\Database\Seeder;

class ScooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scooter::factory()->count(50)->create();
    }
}
