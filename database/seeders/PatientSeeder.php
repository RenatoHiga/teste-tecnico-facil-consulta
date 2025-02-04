<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'nome' => 'Luana Rodrigues',
            'cpf' => '662.669.840-08',
            'celular' => '(11) 9 8484-6363'
        ]);

        Patient::create([
            'nome' => 'Luiza Gonçalves',
            'cpf' => '491.075.050-94',
            'celular' => '(11) 9 8123-4567',
        ]);
    }
}
