<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Database\Seeders\CitySeeder;
use Database\Seeders\DoctorSeeder;
use Database\Seeders\PatientSeeder;
use Database\Seeders\ScheduleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Christian Ramires',
            'email' => 'christian.ramires@example.com',
            'password' => Hash::make('password')
        ]);

        $this->call(CitySeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(ScheduleSeeder::class);
    }
}
