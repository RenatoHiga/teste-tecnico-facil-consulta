<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function get(Request $request) {
        try {
            $name = $request->get('nome', null);

            $city = new City();
            $city = $city->whereLike('nome', '%' . $name . '%');
            $city = $city->orderBy('nome', 'asc');
            $result = $city->get()->all();

            return response()->json($result, 200);
        } catch (\Throwable $error) {
            return response()->json([
                'error' => 'An internal error ocurred.'
            ], 500);
        }
    }
}
