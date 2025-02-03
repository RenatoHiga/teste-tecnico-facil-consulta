<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Doctor;

class DoctorController extends Controller
{
    public function get(Request $request, $id_city = NULL) {
        try {
            $name = $request->get('nome');
            $doctors = new Doctor();

            $name_filter_exists = !empty($name);
            $id_city_exists = !empty($id_city);

            if ($name_filter_exists) {
                $doctors = $doctors->whereLike('nome', "%$name%");
            }
           
            if ($id_city_exists) {
                $doctors->where('cidade_id', '=', $id_city);
            }

            $doctors = $doctors->orderBy('nome', 'asc')->get()->all();

            $doctors_not_found = empty($doctors);
            if ($doctors_not_found) {
                return response()->json([
                    'error' => 'Nenhum médico encontrado.'
                ], 404);
            } 
            
            return response()->json($doctors, 200);
        } catch (\Throwable $error) {
            return showInternalError();
        }
    }

    public function create(Request $request) {
        try {
            $name = $request->get('nome');
            $speciality = $request->get('especialidade');
            $city_id = $request->get('cidade_id');

            $has_an_empty_field = (
                empty($name)
                || empty($speciality)
                || empty($city_id)
            );

            if ($has_an_empty_field) {
                return response()->json([
                    'error' => 'Todos os campos devem ser preenchidos!'
                ], 400);
            }

            $result = Doctor::create([
                'nome' => $name,
                'especialidade' => $speciality,
                'cidade_id' => $city_id
            ]);

            return response()->json($result, 200);
        } catch (\Throwable $error) {
            return showInternalError();
        }
    }
}
