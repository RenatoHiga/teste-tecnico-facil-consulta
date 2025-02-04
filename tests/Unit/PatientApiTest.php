<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;

class PatientApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_patient(): void
    {
        $patientController = new PatientController();

        $result = json_decode($patientController->create(new Request([
            'nome' => 'Matheus Henrique',
            'cpf' => '795.429.941-60',
            'celular' => '(11) 9 8432-5789'
        ]))->getContent());

        $this->assertIsObject($result);
    }
    
    public function test_update_patient(): void
    {
        $patientController = new PatientController();

        $result = json_decode($patientController->update(new Request([
            'nome' => 'Luana Rodrigues Garcia',
            'celular' => '(11) 98484-6362'
        ]), 1)->getContent());

        $this->assertIsObject($result);
        $this->assertEquals('Luana Rodrigues Garcia', $result->nome);
    }

    // public function test_get_patient(): void
    // {
    //     $patientController = new PatientController();

    //     $result = json_decode($patientController->get(new Request([]))->getContent());

    //     $this->assertIsArray($result);
    // }
}
