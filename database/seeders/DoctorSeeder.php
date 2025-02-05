<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'nome' => 'Dr. Renan Fidalgo Domingues',
            'especialidade' => 'Neurologia',
            'cidade_id' => 2
        ]);

        Doctor::create([
            'nome' => 'Juliana Léia Neves Jr.',
            'especialidade' => 'Dermatologia',
            'cidade_id' => 1
        ]);

        Doctor::create([
            'nome' => 'Juliane Ortega',
            'especialidade' => 'Oftalmologia',
            'cidade_id' => 3
        ]);
    }
}
