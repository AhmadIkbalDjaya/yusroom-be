<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "username" => "0101",
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("password"),
            "is_admin" => 1,
        ]);
        User::create([
            "username" => "001",
            "name" => "sukri",
            "email" => "sukri@gmail.com",
            "password" => bcrypt("password"),
        ]);
        User::create([
            "username" => "002",
            "name" => "sauki",
            "email" => "sauki@gmail.com",
            "password" => bcrypt("password"),
        ]);
    }
}
