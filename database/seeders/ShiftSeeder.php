<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        $shifts = [
            ['name' => 'Morning Shift',   'code' => 'MOR', 'start_time' => '07:00', 'end_time' => '15:00', 'break_duration' => 1.0],
            ['name' => 'Afternoon Shift',  'code' => 'AFT', 'start_time' => '14:00', 'end_time' => '22:00', 'break_duration' => 1.0],
            ['name' => 'Night Shift',      'code' => 'NGT', 'start_time' => '22:00', 'end_time' => '06:00', 'break_duration' => 1.0],
            ['name' => 'General Shift',    'code' => 'GEN', 'start_time' => '08:00', 'end_time' => '17:00', 'break_duration' => 1.0],
            ['name' => 'Flexible Shift',   'code' => 'FLX', 'start_time' => '07:00', 'end_time' => '16:00', 'break_duration' => 1.0],
        ];

        foreach ($shifts as $shift) {
            Shift::create($shift);
        }
    }
}
