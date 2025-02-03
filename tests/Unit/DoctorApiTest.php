<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\TestCase;

use App\Http\Controllers\DoctorController;

class DoctorApiTest extends TestCase
{
    public function test_create_doctor(): void {
        $doctorController = new DoctorController();
    
        $request = new Request([
            'nome' => 'Dra. Alessandra Moura',
            'especialidade' => 'Neurologista',
            'cidade_id' => '1'
        ]);

        $result = json_decode($doctorController->create($request)->getContent());

        $this->assertIsObject($result);
    }

    public function test_list_doctors(): void
    {
        $doctorController = new DoctorController();

        $result = json_decode($doctorController->get(new Request())->getContent());
        $result_is_array = gettype($result) == 'array';
        $result_has_doctors = count($result) > 0;

        
        $this->assertTrue($result_is_array);
        $this->assertTrue($result_has_doctors);
    }

    public function test_get_doctor_with_filter(): void {
        $doctorController = new DoctorController();

        $doctorController->create(new Request([
            'nome' => 'Aurora Delgado',
            'especialidade' => 'Neurologista',
            'cidade_id' => '1'
        ]));

        $doctorController->create(new Request([
            'nome' => 'Dr. Milene Cristiana Ortiz Sobrinho',
            'especialidade' => 'Neurologia',
            'cidade_id' => '3'
        ]));

        $result = json_decode($doctorController->get(new Request([
            'nome' => 'Alessandra'
        ]))->getContent());

        $is_doctor_alessandra = $result[0]->nome == 'Dra. Alessandra Moura';

        $this->assertTrue($is_doctor_alessandra);
    }

    public function test_get_doctor_with_id_city_filter(): void {
        $doctorController = new DoctorController();

        $result = json_decode($doctorController->get(new Request(), 1)->getContent());

        $is_doctor_from_id_city_one = $result[0]->cidade_id == '1';

        $this->assertTrue($is_doctor_from_id_city_one);
    }
}
