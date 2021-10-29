<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("admin"),
            "is_admin" => 1
        ]);
        DB::table("users")->insert([
            "name" => "manager",
            "email" => "manager@gmail.com",
            "password" => Hash::make("manager"),
            "is_admin" => 0
        ]);
        User::factory()->count(100)->create();
    }
}
