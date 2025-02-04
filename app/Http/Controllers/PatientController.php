<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class PatientController extends Controller
{
    public function get(Request $request, $id_doctor) {
        try {
            $only_scheduled = $request->get('apenas-agendadas');
            $name = $request->get('nome');

            $json_consulta = "json_object(
                'id', consulta.id,
                'medico_id', consulta.medico_id,
                'paciente_id', consulta.paciente_id,
                'data', consulta.data,
                'created_at', consulta.created_at,
                'updated_at', consulta.updated_at,
                'deleted-at', consulta.deleted_at
            ) as consulta";

            $patients = new Patient();
            $patients = $patients->select(['paciente.*', DB::raw($json_consulta)]);

            $patients = $patients->join('consulta', 'paciente.id', '=', 'consulta.paciente_id');
            $patients = $patients->where('medico_id', $id_doctor);
            $patients = $patients->orderBy('consulta.data', 'ASC');

            $has_only_scheduled_filter = !empty($only_scheduled);
            $has_name_filter = !empty($name);
            if ($has_only_scheduled_filter) {
                $patients->where('consulta.data', '>', date('YYYY-mm-dd H:i:s'));
            }

            if ($has_name_filter) {
                $patients->whereLike('name', "%$name%");
            }

            $patients = $patients->get();
            $patients_decoded = [];

            foreach ($patients as $patient) {
                $patient_decoded = $patient;
                $patient_decoded->consulta = json_decode($patient_decoded->consulta);
                array_push($patients_decoded, $patient_decoded);
            }

            return response()->json($patients_decoded);

        } catch (\Throwable $error) {dd($error);
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
