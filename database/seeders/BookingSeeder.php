<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            "user_id" => 1,
            "room_id" => 1,
            "booking_date" => Carbon::now("Asia/Makassar")->format("Y-m-d"),
            "start_time" => "09:00:00",
            "end_time" => "10:00:00",
            "is_approved" => false,
            "description" => "rapat",
        ]);
        Booking::create([
            "user_id" => 2,
            "room_id" => 1,
            "booking_date" => Carbon::now("Asia/Makassar")->format("Y-m-d"),
            "start_time" => "13:00:00",
            "end_time" => "14:00:00",
            "is_approved" => false,
            "description" => "rapat",
        ]);
        Booking::create([
            "user_id" => 2,
            "room_id" => 1,
            "booking_date" => Carbon::now("Asia/Makassar")->format("Y-m-d"),
            "start_time" => "13:00:00",
            "end_time" => "14:00:00",
            // "is_approved" => false,
            "description" => "rapat",
        ]);
        Booking::create([
            "user_id" => 2,
            "room_id" => 1,
            "booking_date" => Carbon::now("Asia/Makassar")->format("Y-m-d"),
            "start_time" => "13:30:00",
            "end_time" => "14:00:00",
            // "is_approved" => false,
            "description" => "rapat",
        ]);
        Booking::create([
            "user_id" => 2,
            "room_id" => 1,
            "booking_date" => Carbon::now("Asia/Makassar")->format("Y-m-d"),
            "start_time" => "13:50:00",
            "end_time" => "14:00:00",
            // "is_approved" => false,
            "description" => "rapat",
        ]);
    }
}
