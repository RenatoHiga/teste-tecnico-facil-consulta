<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function get(Request $request, $id_doctor) {
        try {
            $only_scheduled = $request->get('apenas-agendadas');
            $name = $request->get('nome');
        } catch (\Throwable $error) {
            return showInternalError();
        }
    }

    public function create(Request $request) {
        try {
            $name = $request->get('nome');
            $cpf = $request->get('cpf');
            $phone = $request->get('celular');

            $has_any_empty_field = (
                empty($name)
                || empty($cpf)
                || empty($phone)
            );

            if ($has_any_empty_field) {
                return response()->json([
                    'error' => 'È necessário preencher todos os campos.'
                ], 400);
            }

            $result = Patient::create([
                'nome' => $name,
                'cpf' => $cpf,
                'celular' => $phone,
            ]);

            return response()->json($result);
        } catch (\Throwable $error) {
            return showInternalError();
        }
    }

    public function update(Request $request, $id_patient) {

        try {
            $patient = Patient::find($id_patient);
            $patient->nome = $request->get('nome', $patient->nome);
            $patient->celular = $request->get('celular', $patient->celular);
            $patient->save();
            
            return response()->json($patient);
        } catch (\Throwable $error) {
            return showInternalError();
        }
    }
}
