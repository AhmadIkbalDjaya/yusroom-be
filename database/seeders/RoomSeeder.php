<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            "name" => "Ruang Rapat",
            // "capacity" => 25,
            "image" => "rooms/default.jpg",
            "description" => "",
            "is_active" => true,
        ]);
        Room::create([
            "name" => "Ruang Rapat2",
            // "capacity" => 15,
            "image" => "rooms/default.jpg",
            "description" => "Ruang Rapat ke dua",
            "is_active" => false,
        ]);
        Room::create([
            "name" => "Ruang Rapat3",
            // "capacity" => 25,
            "image" => "rooms/default.jpg",
            "description" => "ruang rapat 3",
            "is_active" => true,
        ]);
    }
}
