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
            "image" => "/images/dsada.jpf",
            "description" => "",
            "is_active" => true,
        ]);
        Room::create([
            "name" => "Ruang Rapat2",
            // "capacity" => 15,
            "image" => "/images/dsada.jpf",
            "description" => "Ruang Rapat ke dua",
            "is_active" => false,
        ]);
    }
}
