<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Http\Controllers\CityController;

class CityApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_city_sao_paulo(): void
    {
        $cityController = new CityController();

        $request = new Request([
            'nome' => 'sao paulo'
        ]);

        $result = json_decode($cityController->get($request)->getContent());

        $this->assertEquals('São Paulo', $result[0]->nome);
    }
}
