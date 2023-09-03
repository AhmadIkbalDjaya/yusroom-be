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
            "name" => "Ruangan 1",
            "image" => "rooms/default.jpg",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quis eos excepturi accusantium, doloribus dolorem?",
            "is_active" => true,
        ]);
        Room::create([
            "name" => "Ruangan 2",
            "image" => "rooms/default.jpg",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quis eos excepturi accusantium, doloribus dolorem?",
            "is_active" => false,
        ]);
        Room::create([
            "name" => "Ruangan 3",
            "image" => "rooms/default.jpg",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quis eos excepturi accusantium, doloribus dolorem?",
            "is_active" => true,
        ]);
    }
}
