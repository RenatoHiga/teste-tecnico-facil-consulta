<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create([
            'medico_id' => 1,
            'paciente_id' => 1,
            'data' =>date('Y-m-d H:i:s', strtotime('+12 Hour'))
        ]);
    }
}
