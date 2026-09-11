<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\State;
use App\LaboralCompany;
use App\User;
use Validator;
use Auth;

class PatientController extends Controller
{

    public function index(Request $request)
    {
        $collection = [];
        if ($term = $request->input('search')) {
            $collection = Patient::all();
            $term = strtolower($term);
            $splitted_term = explode(' ', $term);
            $numberOfTerms = count($splitted_term);
            $collection = $collection->filter(function ($patient) use ($splitted_term, $numberOfTerms) {
                $name = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($patient->full_name, ENT_QUOTES, 'UTF-8'))), ' '));
                $matchedTermsCount = 0;
                foreach ($splitted_term as $term) {
                    $parsed_term = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($term, ENT_QUOTES, 'UTF-8'))), ' '));
                    if (is_numeric(strpos($name, $term))) {
                        $matchedTermsCount++;
                    }
                }
                if ($matchedTermsCount == $numberOfTerms) {
                    return true;
                }
                return false;
            });
            if (
                !Auth::user()->admin &&
                (Auth::user()->rol->name == "traumatologo" ||
                    Auth::user()->rol->name == "rehabilitador" ||
                    Auth::user()->rol->name == "nutriologo")
            ) {
                $collection = $collection->where('responsible_id', Auth::user()->id);
            }
        }
        if ($collection && !empty($request->input('laboral'))) {
            if ($collection) {
                $collection = $collection->where('is_laboral', 1);
            }
        }
        if ($request->input('laboral') == 1) {
            return view("patient.nordic_index")->with("collection", $collection)
                ->with('laboral', 1);
        }
        if ($request->input('laboral') == 3) {
            return view("patient.employees")->with("collection", $collection)
                ->with('laboral', 3);
        } else if ($request->input('laboral') == 5) {
            return view("patient.nordic_index")->with("collection", $collection)
                ->with('laboral', 5);
        } else if ($request->input('laboral') == 11) {
            return view("patient.cargas_index")->with("collection", $collection)
                ->with('laboral', 11);
        } else if ($request->input('laboral') == 2) {
            return view("patient.evaluaciones_index")->with("collection", $collection)
                ->with('laboral', 2);
        } else {
            return view("patient.index")->with("collection", $collection);
        }
    }
    public function create()
    {
        $responsibleIdOptions = User::all()->pluck('name', 'id');
        if (request()->input('is_laboral')) {
            return view("patient.add_employee")->with('states', State::all())
                ->with('responsibleIdOptions', $responsibleIdOptions)
                ->with('laboralCompanies', LaboralCompany::all()->pluck('name', 'id'));
        }
        return view("patient.create")->with('states', State::all())
            ->with('responsibleIdOptions', $responsibleIdOptions);
    }
    public function edit(Patient $paciente)
    {
        $responsibleIdOptions = User::all()->pluck('name', 'id');
        if (request()->input('is_laboral')) {
            return view("patient.add_employee")->with('states', State::all())
                ->with('responsibleIdOptions', $responsibleIdOptions)
                ->with('laboralCompanies', LaboralCompany::all()->pluck('name', 'id'));
        }
        return view("patient.create")
            ->with('states', State::all())
            ->with('responsibleIdOptions', $responsibleIdOptions)
            ->with('model', $paciente);
    }
    public function store(Request $request)
    {
        $res = $this->_store_patient($request);
        if ($res !== true) {
            return $res;
        }
        $routeToGo = $request->input('route_to_go', null);
        if ($routeToGo) {
            return redirect(route($routeToGo))->with(['createdPatient' => 'Tu paciente ha sido modificado']);
        }
        return $res ? $res : redirect(route('employees.index', ['laboral' => 3]))->with(['createdPatient' => 'Tu paciente ha sido creado']);
    }
    public function update(Request $request, Patient $paciente)
    {
        $res = $this->_store_patient($request, $paciente, true);
        if ($res !== true) {
            return $res;
        }
        $routeToGo = $request->input('route_to_go', null);
        if ($routeToGo) {
            return redirect(route($routeToGo))->with(['createdPatient' => 'Tu paciente ha sido modificado']);
        }
        return $res ? $res : redirect(route('employees.index', ['laboral' => 3]))->with(['createdPatient' => 'Tu paciente ha sido modificado']);
    }

    public function destroy(Request $request, Patient $paciente)
    {
        $res = $paciente->delete();
        return redirect(action('PatientController@index'))->with(['createdPatient' => 'Tu paciente ha sido eliminado']);
    }

    private function _store_patient($request, $patient = false, $isUpdate = false)
    {
        if (!$request->input('is_laboral')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'surname' => 'required|max:255',
                'birth_date' => 'required|before:' . date(now()),
                'birth_state_id' => [
                    'required',
                    'integer',
                    function ($attribute, $value, $fail) {
                        if ($value == 33) {
                            $fail('Por favor selecciona un estado de nacimiento');
                        }
                    }
                ],
                'birth_municipality_id' => [
                    'required',
                    'integer',
                    function ($attribute, $value, $fail) {
                        if ($value == 1 || $value == 0) {
                            $fail('Por favor selecciona un municipio de nacimiento');
                        }
                    }
                ],
                'email' => 'nullable|email',
            ], [
                'name.required' => 'El nombre debe ser definido',
                'surname.required' => 'El apellido paterno debe ser definido',
                'birth_date.required' => 'La fecha de nacimiento debe ser definida',
                'birth_date.before' => 'Introduce una fecha de nacimiento antes del día de hoy',
                'birth_municipality_id.required' => 'Por favor selecciona un municipio de nacimiento',
                'email.email' => 'El formato del correo electrónico no es válido',
            ]);
            if ($validator->fails()) {
                if (!$isUpdate) {
                    return redirect(route('pacientes.create'))
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    return redirect(route('pacientes.edit', ['paciente' => $patient->id]))
                        ->withErrors($validator)
                        ->withInput();
                }
            }
        }
        $A_request = $request->all();
        $A_request['sex'] = $A_request['sex'] == '1' ? true : false;
        unset($A_request['_token']);
        unset($A_request['workspace']);
        if (!$patient) {
            $patient = new Patient($A_request);
        } else {
            $patient->fill($A_request);
        }
        $patient->workspace_id = $request->input('workspace', [null])[0];
        return $patient->save();
        return true;
    }
}
