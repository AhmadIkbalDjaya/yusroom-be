<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $times = [
            ['start_time' => '09:00:00', 'end_time' => '10:00:00'],
            ['start_time' => '11:30:00', 'end_time' => '12:30:00'],
            ['start_time' => '14:00:00', 'end_time' => '15:00:00'],
            ['start_time' => '16:30:00', 'end_time' => '17:30:00'],
            ['start_time' => '19:00:00', 'end_time' => '20:00:00'],
        ];

        foreach ($times as $time) {
            Time::create($time);
        }
    }
}
