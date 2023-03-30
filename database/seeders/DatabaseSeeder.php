<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "nik" => "001",
            "name" => "sukri",
            "email" => "sukri@gmail.com",
            "password" => bcrypt("password"),
        ]);
        User::create([
            "nik" => "002",
            "name" => "sauki",
            "email" => "sauki@gmail.com",
            "password" => bcrypt("password"),
        ]);

        Room::create([
            "name" => "Ruang Rapat",
            "capacity" => 25,
            "description" => "",
            "is_active" => true,
        ]);

        Booking::create([
            "user_id" => 1,
            "room_id" => 1,
            "booking_date" => "2023-03-30",
            "start_time" => "09:00:00",
            "end_time" => "10:00:00",
            "is_approved" => false,
        ]);
        Booking::create([
            "user_id" => 2,
            "room_id" => 1,
            "booking_date" => "2023-03-31",
            "start_time" => "13:00:00",
            "end_time" => "14:00:00",
            "is_approved" => false,
        ]);
        Booking::create([
            "user_id" => 2,
            "room_id" => 1,
            "booking_date" => "2023-03-29",
            "start_time" => "13:00:00",
            "end_time" => "14:00:00",
            "is_approved" => false,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
