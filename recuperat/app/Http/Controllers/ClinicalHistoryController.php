<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\ClinicalHistory;
use App\Patient;
use App\Valoration;
use App\Decision;
use App\Laboratorio;
use App\WeightLiftEvaluation;
use App\Session;
use App\SessionObjective;
use App\ClinicalHistoryDiagnosis;
use Illuminate\Http\Request;
use Auth;
use Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use \Illuminate\Http\Response;
use \Illuminate\Routing\Redirector;
use \Illuminate\Http\RedirectResponse;

class ClinicalHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error' => 'No se puede acceder a esta página']);
    }

    /**
     * KEY METHOD: Show the form for creating a new ClinicalHistory. This mthod includes all clinical evaluations with an If.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $stop_extend = false): View
    {
        set_time_limit(180);
        $request->session()->put('opened_patient', $request->patient_id);
        $request->session()->put('id_clinical_history', $request->id_clinical_history);
        $patient_id = !empty($request->patient_id) ? $request->patient_id : 1;
        $patient = Patient::find($request->patient_id);
        $antecedents = $this->_getParameterFromClinicalHistory($patient_id, 'antecedents');
        $valorations = $this->_getParameterFromClinicalHistory($patient_id, 'valorations') ? $this->_getParameterFromClinicalHistory($patient_id, 'valorations')->reverse() : false;
        $abstract_24 = $this->_getParameterFromClinicalHistory($patient_id, 'valorations', 'abstract_24_hours_nutriology');
        $clinicalHistory = Patient::find($patient_id)->clinicalHistory;
        if (!$clinicalHistory) {
            $patient->clinicalHistory()->create([
                'user_id' => Auth::user()->id
            ]);
            $clinicalHistory = $patient->clinicalHistory;
        }
        $requested_valoration_id = $request->id_clinical_history;
        if (((Auth::user()->rol->name == "fisioterapeuta" || Auth::user()->rol->name == 'estudiantes') && ($request->id_clinical_history == 1 || !$request->id_clinical_history)) || ($request->id_clinical_history == 1 && Auth::user()->rol->name == 'admin')) {
            $allFiles = $this->_allFiles($patient_id);
            return view('clinical_histories.create_fisiotherapy_clinical_history')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('clinicalHistory', $clinicalHistory)->
                with('abstract_24', $abstract_24)->
                with('valorations', $valorations)->
                with('files', $allFiles);
        }
        if ((Auth::user()->rol->name == "rehabilitador" && ($request->id_clinical_history == 1 || !$request->id_clinical_history)) || ($request->id_clinical_history == 1 && Auth::user()->rol->name == 'admin')) {
            $allFiles = $this->_allFiles($patient_id);
            return view('clinical_histories.create_clinical_history_rehabilitation')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('clinicalHistory', $clinicalHistory)->
                with('abstract_24', $abstract_24)->
                with('valorations', $valorations)->
                with('files', $allFiles);
        } elseif (((Auth::user()->rol->name == 'admin' || Auth::user()->rol->name == "nutriologo") && ($request->id_clinical_history == 2 || !$request->id_clinical_history))) {
            $allFiles = $this->_allFiles($patient_id);
            return view('clinical_histories.create_nutriology_clinical_history')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('abstract_24', $abstract_24)->
                with('valorations', $valorations)->
                with('files', $allFiles);
        } elseif ((Auth::user()->rol->name == "traumatologo" || ($request->id_clinical_history == 3 && Auth::user()->rol->name == 'admin'))) {
            $allFiles = $this->_allFiles($patient_id);
            return view('clinical_histories.create_traumatology_clinical_history')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations)->
                with('files', $allFiles);
        } elseif ($request->id_clinical_history == 4) {
            return view('valorations.create_valoration_muscular')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('stop_extend', $stop_extend)->
                with('valorations', $valorations);
        }
        //NÓRDICO
        elseif ($request->id_clinical_history == 5) {
            return view('valorations.create_valoration_nordic')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //MANO
        elseif ($request->id_clinical_history == 6) {
            return view('valorations.create_valoration_physiotherapy_hand')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //ELBOW
        elseif ($request->id_clinical_history == 7) {
            return view('valorations.laboral_physiotherapy.create_valoration_laboral_elbow')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //SHOULDER
        elseif ($request->id_clinical_history == 8) {
            return view('valorations.laboral_physiotherapy.create_valoration_laboral_shoulder')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //Cervical column
        elseif ($request->id_clinical_history == 9) {
            return view('valorations.laboral_physiotherapy.create_valoration_cervical_column')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //LUMBAR COLUMN
        elseif ($request->id_clinical_history == 10) {
            return view('valorations.laboral_physiotherapy.create_valoration_lumbar_column')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //Weight Lifting
        elseif ($request->id_clinical_history == 11) {
            // get last clinical history
            $lastLiftEvaluation = $clinicalHistory->weight_lift_evaluations->last();
            if (!$lastLiftEvaluation) {
                $lastLiftEvaluation = WeightLiftEvaluation::create([
                    'user_id' => Auth::user()->id,
                    'clinical_history_id' => $clinicalHistory->id,
                    'metadata' => '{}'
                ]);
            }
            return view('valorations.weight_lifting.edit')
                ->with('clinicalHistoryId', $clinicalHistory->id)
                ->with('evaluation', $lastLiftEvaluation)
                ->with('patient', json_encode($clinicalHistory->patient))
                ->with('responsible', $clinicalHistory->patient->responsible)
                ->with('laboral_company', $clinicalHistory->patient->laboralCompany)
                ->with('workspace', $clinicalHistory->patient->workspace)
                ->with('useVue', true);
        }
        //POSTURE
        elseif ($request->id_clinical_history == 12) {
            return view('valorations.valoration_postural')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //MARCHA
        elseif ($request->id_clinical_history == 13) {
            return view('valorations.create_valoration_gait')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //GONIOMETRY
        elseif ($request->id_clinical_history == 14) {
            return view('valorations.create_valoration_goniometry')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }

        //Evolución SOAP
        elseif ($request->id_clinical_history == 15 && (Auth::user()->rol->name == 'admin' || Auth::user()->rol->name == 'fisioterapeuta' || Auth::user()->rol->name == 'nutriologo' || Auth::user()->rol->name == 'rehabilitador' || Auth::user()->rol->name == 'estudiantes')) {
            $valorations = $valorations->map(function ($valoration) {
                $valoration->user = \App\User::find($valoration->user_id);
                return $valoration;
            });

            return view('valorations.create_valoration_evolution_physiotherapy')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('clinical_history', $clinicalHistory)->
                with('valorations', $valorations);
        }
        //PROGRAMA FISIOTERAPEUTICO EN CASA
        elseif ($request->id_clinical_history == 16) {
            return view('valorations.create_home_physiotherapy_program')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //VALORACIÓN FUNCIONAL
        elseif ($request->id_clinical_history == 17) {
            return view('valorations.create_valoration_functional_valoration')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }

        //VALORACIÓN DEPORTIVA
        elseif ($request->id_clinical_history == 18) {
            return view('valorations.create_valoration_deportive_valoration')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //Valoración pediátrica
        elseif ($request->id_clinical_history == 19) {
            return view('valorations.create_valoration_pediatric_valoration')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        //HC de rehabilitación
        elseif ($request->id_clinical_history == 20 && (Auth::user()->rol->name == 'admin' || Auth::user()->rol->name == 'rehabilitador')) {
            $allFiles = $this->_allFiles($patient_id);
            return view('clinical_histories.create_clinical_history_rehabilitation')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('users', \App\User::all()->pluck('name', 'id'))->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations)->
                with('files', $allFiles);
        }//VALORATION ortopedia
        elseif ($request->id_clinical_history == 21 && (Auth::user()->rol->name == 'admin' || Auth::user()->rol->name == 'traumatologo')) {
            return view('clinical_histories.create_clinical_history_orthopedy')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        } elseif ($request->id_clinical_history == 22 && (Auth::user()->rol->name == 'admin' || Auth::user()->rol->name == 'fisioterapeuta')) {
            return view('valorations.section_valoration_muscular_valoration_knee')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        } elseif ($request->id_clinical_history == 23 && (Auth::user()->rol->name == 'admin' || Auth::user()->rol->name == 'fisioterapeuta')) {
            return view('valorations.section_valoration_muscular_valoration_feet')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        }
        // Reflexología
        elseif ($request->id_clinical_history == 24) {
            $allFiles = $this->_allFiles($patient_id);
            return view('valorations.create_valoration_reflexology_valoration')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations)->
                with('files', $allFiles);
        }
        // Acupuntura
        elseif ($request->id_clinical_history == 25) {
            $allFiles = $this->_allFiles($patient_id);
            return view('clinical_histories.create_acupuncture_clinical_history')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations)->
                with('files', $allFiles);
        } elseif ($request->id_clinical_history == 26) {
            $newObjective = $request->input('new_objective', false);
            $lastObjective = !$newObjective ? ($clinicalHistory->valorations->where('section', 'physiotherapy_classic_objective')->last()) : null;
            $allObjectives = !$newObjective ? ($clinicalHistory->valorations->where('section', 'physiotherapy_classic_objective')->unique('json_values')) : null;
            return view('sessions.edit')->with('clinicalHistoryId', $clinicalHistory->id)
                ->with('patient', json_encode($clinicalHistory->patient))
                ->with('responsible', $clinicalHistory->patient->responsible)
                ->with('useVue', true);
        } elseif ($request->id_clinical_history == 27) {
            $lastNote = $clinicalHistory->clinical_physiotherapy_notes->last();
            // $allFiles = $this->_allFiles($patient_id);
            $allFiles = [];
            return view('clinical_histories.clinical_note_physiotherapy')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('files', $allFiles)->
                with('model', $lastNote)->
                with('lastNote', $lastNote)->
                with('clinicalHistory', $clinicalHistory);
        } elseif ($request->id_clinical_history == 28) {
            $lastNote = $clinicalHistory->clinical_rehabilitation_notes->last();
            // $allFiles = $this->_allFiles($patient_id);
            $allFiles = [];
            return view('clinical_histories.clinical_note_rehabilitation')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('users', \App\User::all()->pluck('name', 'id'))->
                with('patient', $patient)->
                with('files', $allFiles)->
                with('model', $lastNote)->
                with('lastNote', $lastNote)->
                with('clinicalHistory', $clinicalHistory);
        }
        // Barthel
        elseif ($request->id_clinical_history == 29) {
            return view('valorations.create_valoration_barthel')->with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('valorations', $valorations);
        } else {
            return view('clinical_histories.create_fisiotherapy_clinical_history')->
                with('patient_id', !empty($patient_id) ? $patient_id : false)->
                with('patient', $patient)->
                with('antecedents', $antecedents)->
                with('clinicalHistory', $clinicalHistory)->
                with('abstract_24', $abstract_24)->
                with('valorations', $valorations);
        }
    }

    /**
     * Get the array to print valorations
     * @param \Illuminate\Http\Request $request
     * @return array|object
     */
    public function printValoration(Request $request)
    {
        $data = $request->input('data');
        if (!is_array($data))
            return [];
        $objectivesNames = array_map(function ($objective) {
            return $objective['name'];
        }, $data);
        $objectivesNames = array_filter($objectivesNames, function ($objective) {
            return !!$objective;
        });
        $patientId = $request->input('patient_id');
        $clinicalHistoryId = Patient::find($patientId)->clinicalHistory->id;
        $valorations = \DB::table('valorations')
            ->where('clinical_history_id', $clinicalHistoryId)
            ->where('section', 'physiotherapy_classic_objective')
            ->orWhere('section', 'physiotherapy_classic_numero_de_sesion')
            ->orWhere('section', 'physiotherapy_classic_actividades')
            ->orWhere('section', 'physiotherapy_classic_observaciones')
            ->orWhere('section', 'physiotherapy_classic_fisioterapeuta')
            ->orderBy('updated_at')
            ->get();

        $workingUpdatedAt = '';
        $sessionsArray = [];
        foreach ($valorations->where('section', 'physiotherapy_classic_objective') as $valorationObjective) {
            if ($objectivesNames) {
                if (!in_array($valorationObjective->json_values, $objectivesNames))
                    continue;
            }
            $modelValoration = Valoration::find($valorationObjective->id);
            $valoration = $valorations->
                where('updated_at', '>', $modelValoration->updated_at->subSeconds(1))->
                where('updated_at', '<', $modelValoration->updated_at->addSeconds(1));
            $array = [];
            $objective = $valoration->where('name', "Objetivo")->first() ? $valoration->where('name', "Objetivo")->first()->json_values : '';
            $array['Objetivo'] = $valoration->where('name', "Objetivo")->first() ? $valoration->where('name', "Objetivo")->first()->json_values : '';
            $array['Numero de sesión'] = $valoration->where('name', "Numero de sesión")->first() ? $valoration->where('name', "Numero de sesión")->first()->json_values : '';
            $array['updated_at'] = $valoration->where('name', "Numero de sesión")->first() ? $valoration->where('name', "Numero de sesión")->first()->updated_at : '';
            $array['Actividades'] = $valoration->where('name', "Actividades")->first() ? $valoration->where('name', "Actividades")->first()->json_values : '';
            $array['Observaciones'] = $valoration->where('name', "Observaciones")->first() ? $valoration->where('name', "Observaciones")->first()->json_values : '';
            $array['Fisioterapeuta'] = $valoration->where('name', "Fisioterapeuta")->first() ? $valoration->where('name', "Fisioterapeuta")->first()->json_values : '';
            $sessionsArray[$objective][] = $array;
        }
        $orderedSessionArray = [];
        array_walk($sessionsArray, function ($sessionDate, $key) use (&$orderedSessionArray) {
            uasort($sessionDate, function ($sessionA, $sessionB) use (&$orderedSessionArray) {
                return $sessionA['Numero de sesión'] > $sessionB['Numero de sesión'];
            });
            $orderedSessionArray[$key] = $sessionDate;
        });
        return ($sessionsArray);

    }

    /**
     * Get a parameter from clinical history by name
     * @param mixed $patient_id
     * @return mixed
     */
    public function _getParameterFromClinicalHistory($patient_id, $parameter, $name = false)
    {
        if (!empty($patient_id)) {
            if (($patient = Patient::find($patient_id))) {
                if ($patient->clinicalHistory) {
                    if (!$name) {
                        return $patient->clinicalHistory->$parameter;
                    } else {
                        return $patient->clinicalHistory->$parameter->where('name', $name);
                    }
                }
            }
        }
        return false;
    }

    /**
     * Add a session to read the clinical history from
     * @param mixed $patient_id
     * @return mixed
     */

    public function addSession(Request $request)
    {
        $session = $request->input('session');
        $session = Session::create($session);
        return $session;
    }

    /**
     * Delete a session from the clinical history
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return mixed
     */
    public function deleteSession(Request $request, $id)
    {
        $session = Session::find($id);
        $session->delete();
        return $id;
    }

    /**
     * Update a session from the clinical history
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return mixed
     */
    public function updateSession(Request $request, $id)
    {
        $session = Session::find($id);
        $session->update($request->input('session'));
        return $session;
    }

    /**
     * Get all sessions from the clinical history
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function allSession(Request $request)
    {
        return Session::where('clinical_history_id', $request->input('clinical_history_id'))->get();
    }
    /**
     * Add a session objective to the clinical history
     * @param \Illuminate\Http\Request $request
     * @return SessionObjective|\Illuminate\Database\Eloquent\Model
     */
    public function addSessionObjective(Request $request)
    {
        $sessionObjective = $request->input('sessionObjective');
        $sessionObjective = SessionObjective::create($sessionObjective);
        return $sessionObjective;
    }
    /**
     * Delete a session objective from the clinical history
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return mixed
     */
    public function deleteSessionObjective(Request $request, $id)
    {
        $sessionObjective = SessionObjective::find($id);
        $sessionObjective->delete();
        return $id;
    }
    /**
     * Update a session objective from the clinical history
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return int|SessionObjective|SessionObjective[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateSessionObjective(Request $request, $id)
    {
        $sessionObjective = SessionObjective::find($id);
        if ($request->input('name')) {
            $sessionObjective->update([
                "name" => $request->input('name')
            ]);
            return $sessionObjective;
        }
        return 0;
    }
    /**
     * Get all session objectives from the clinical history
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function allSessionObjective(Request $request)
    {
        return SessionObjective::where('clinical_history_id', $request->input('clinical_history_id'))->get();
    }
    /**
     * Key Method Store a newly created Clinical History in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        set_time_limit(180);
        // dd($request->all());
        if ($request->session()->has('opened_patient')) {
            $patient_id = $request->session()->get('opened_patient');
            $patient = Patient::find($patient_id);
            $id_clinical_history = $request->session()->get('id_clinical_history');
            $clinical_history = new ClinicalHistory();

            $A_request = $request->all();
            $A_request['patient_id'] = !empty($request->patient_id) ? $request->patient_id : $request->session()->get('opened_patient');
            $clinical_history->saveHistory($A_request);
            $request->session()->forget('opened_patient');
            $request->session()->forget('id_clinical_history');
            $patient->responsible_id = Auth::user()->id;
            return redirect(action('ClinicalHistoryController@create', ['patient_id' => $patient_id, 'id_clinical_history' => $id_clinical_history]))->with('modifiedSuccess', 'Historia Modificada');
        } else {
            return redirect(action('ClinicalHistoryController@index'))->with('modifiedFailure', 'Hubo un error al crear la nota');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClinicalHistory  $clinicalHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ClinicalHistory $clinicalHistory)
    {
        return response()->json(['error' => 'No se puede acceder a esta página']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClinicalHistory  $clinicalHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ClinicalHistory $clinicalHistory)
    {
        return response()->json(['error' => 'No se puede acceder a esta página']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClinicalHistory  $clinicalHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClinicalHistory $clinicalHistory)
    {
        return response()->json(['error' => 'No se puede acceder a esta página']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClinicalHistory  $clinicalHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClinicalHistory $clinicalHistory)
    {
        return response()->json(['error' => 'No se puede acceder a esta página']);
    }

    /**
     * Create a decisio´n (homephysioterapy program) for a patient
     * @param \Illuminate\Http\Request $request
     * @param mixed $patient_id
     * @return View
     */
    public function createDecision(Request $request, $patient_id = 0)
    {
        if ($patient_id) {
            $patient = Patient::find($patient_id);
        } else {
            $patient = Patient::find($request->patient_id);
        }
        $laboralCompany = null;
        $img = null;
        if ($patient->is_laboral) {
            $laboralCompany = \App\JobAnalysis::where('patient_id', $patient->id)->first()->workspace->laboral_company;
            $imageResources = $laboralCompany->image_resources->last();
            $img = $imageResources ? $imageResources->url : null;
        }
        $decisions = Decision::with('home_physiotherapy_programs')
            ->with('author')
            ->where('patient_id', $patient->id)->get()->toArray();
        $decisions = array_map(function ($element) {
            $element['user'] = \App\User::find($element['user_id']);
            $element['patient'] = \App\Patient::find($element['patient_id']);
            return $element;
        }, $decisions);
        // dd($decisions);
        $clinics = \App\Clinic::all();
        return view('clinical_histories.clinical_decision')
            ->with('patient', $patient)
            ->with('user', Auth::user())
            ->with('clinics', $clinics)
            ->with('json_decisions', json_encode($decisions))
            ->with('img', $img);
    }

    /**
     * Store a decision (homephysioterapy program) for a patient
     * @param \Illuminate\Http\Request $request
     * @return Redirect
     */

    public function storeDecision(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'text' => 'required'
            ],
            [
                'text.required' => 'El campo de texto de la receta es requerido.'
            ]
        )->validate();
        $A_request = $request->all();
        unset($A_request['home_physiotherapy_programs']);
        unset($A_request['_token']);
        $decision = new Decision();
        $decision->user_id = Auth::id();
        $decision->author_id = Patient::find($request->input('patient_id'))->responsible_id;
        $decision->fill($A_request);
        $decision->save();

        if (!empty($request->home_physiotherapy_programs)) {
            $syncArray = [];
            $home_physiotherapy_programs = $request->home_physiotherapy_programs;
            array_walk($home_physiotherapy_programs, function ($element) use (&$syncArray) {
                $syncArray[$element] = ['password' => Str::random(10)];
            });
            $decision->home_physiotherapy_programs()->sync($syncArray);
        }
        return redirect(route('history.decision.create', $request->patient_id));
    }

    /**
     * Create a laboratory order for a patient
     * @param \Illuminate\Http\Request $request
     * @param mixed $patient_id
     * @return View
     */

    public function createLaboratoryOrder(Request $request, $patient_id = 0)
    {
        if ($patient_id) {
            $patient = Patient::find($patient_id);
        } else {
            $patient = Patient::find($request->patient_id);
        }
        $decisions = Decision::where('patient_id', $patient->id)->get()->toArray();
        $decisions = array_map(function ($element) {
            $element['user'] = \App\User::find($element['user_id']);
            $element['patient'] = \App\Patient::find($element['patient_id']);
            return $element;
        }, $decisions);
        return view('clinical_histories.laboratory_order')
            ->with('patient', $patient)
            ->with('user', Auth::user())
            ->with('studies', Laboratorio::STUDIES)
            ->with('json_decisions', json_encode($decisions));
    }

    /**
     * Store a laboratory order for a patient
     * @param \Illuminate\Http\Request $request
     * @return Redirect
     */

    public function storeLaboratoryOrder(Request $request)
    {
        $A_request = $request->all();
        unset($A_request['_token']);
        $decision = new Decision();
        $decision->user_id = Auth::id();
        $decision->fill($A_request);
        $decision->save();
        return redirect(route('history.decision.create', $request->patient_id));
    }

    /**
     * Delete a medical valoration for a patient
     * @param \Illuminate\Http\Request $request
     * @param mixed $patient_id
     * @return View
     */

    public function valorationDelete(Request $request, $updated_at): int
    {
        $parsedUpdatedAt = str_replace('T', ' ', $updated_at);
        $valorations = \DB::table('valorations')
            ->where('updated_at', str_replace('T', ' ', $parsedUpdatedAt))
            ->delete();
        return $valorations;
    }

    /**
     * Get all files from a patient from google drive
     * @param \Illuminate\Http\Request $request
     * @param mixed $patientId
     * @return mixed
     */

    public function allFiles(Request $request, $patientId)
    {
        return $this->_allFiles($patientId);
    }

    /**
     * Get all files from a patient from google drive
     * @param \Illuminate\Http\Request $request
     * @param mixed $patientId
     * @return mixed
     */

    private function _allFiles($patientId)
    {
        // return [];
        $files = $this->_findMetadataByName("${patientId}_clinical_history_", true);
        return $files;
    }

    /**
     * Add a file to a patient from google drive
     * @param \Illuminate\Http\Request $request
     * @param mixed $patientId
     * @return mixed
     */

    public function addFile(Request $request)
    {
        $ext = $request->file->extension();
        $name = $request->file->getClientOriginalName();
        $patientId = $request->patient_id;
        $randomString = Str::random(5);
        $title = "${patientId}_clinical_history_${randomString}_${name}";
        \Storage::disk('google')->put($title, $request->file->get());
        return response('success');
    }

    /**
     * Remove a file from a patient from google drive
     * @param \Illuminate\Http\Request $request
     * @param mixed $path
     * @return mixed
     */
    public function removeFile(Request $request, $path)
    {
        \Storage::disk('google')->delete($path);
        return response('success');
    }

    /**
     * Download a file from a patient from google drive
     * @param \Illuminate\Http\Request $request
     * @param mixed $fileId
     * @param mixed $fileName
     * @return mixed
     */

    public function downloadFile(Request $request, $fileId, $fileName)
    {
        return \Storage::disk('google')->download($fileId, $fileName);
    }

    /**
     * Get all directories from a patient from google drive
     * @param \Illuminate\Http\Request $request
     * @param mixed $patientId
     * @return mixed
     */
    public function _findMetadataByName($name, $isFile = true)
    {
        if (!$isFile) {
            return Cache::store('redis')->remember(
                'google_files',
                43200,
                function () use ($name) {
                    $files = \Storage::disk('google')->files();
                    $gDriveAdapter = \Storage::disk('google')->getAdapter();
                    $folderMetadata = [];
                    foreach ($files as $file) {
                        $metadata = $gDriveAdapter->getMetadata($file);
                        if (strpos($metadata['name'], $name) !== false) {
                            $folderMetadata[] = $metadata;
                        }
                    }
                    return $folderMetadata;
                }
            );
        }
        $files = $isFile ? \Storage::disk('google')->files() : \Storage::disk('google')->directories();

        $gDriveAdapter = \Storage::disk('google')->getAdapter();
        $folderMetadata = [];
        foreach ($files as $file) {
            $metadata = $gDriveAdapter->getMetadata($file);
            if (strpos($metadata['name'], $name) !== false) {
                $folderMetadata[] = $metadata;
            }
        }
        return $folderMetadata;
    }

    /**
     * Sum values for the results of specific valoration for cervical column
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */

    public function _sumSpecificCervicalColumn(Request $request)
    {
        $valorationNames = [
            'Neuropático' => [
                'valoration_laboral_cervical_column_neuropatic' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Somático' => [
                'valoration_laboral_cervical_column_somatic' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Inflamatorio' => [
                'valoration_laboral_cervical_column_inflamatory' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'EVA' => [
                'valoration_laboral_cervical_column_inflamatory' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Dolor con distribución nerviosa' => [
                'valoration_laboral_column_first_distribution' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Adormecimiento/Debilidad/hormigueos' => [
                'valoration_laboral_column_first_weakness' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Disminución de la fuerza' => [
                'valoration_laboral_column_first_less_strength' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Spuring' => [
                'valoration_laboral_column_first_spuring' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Distracción' => [
                'valoration_laboral_column_first_distraction' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Hipoestesias' => [
                'valoration_laboral_column_first_hipoestesia' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Debilidad' => [
                'valoration_laboral_column_first_weakness' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Neuropatía sensitiva' => [
                'valoration_laboral_column_first_sensitive_neuropathy' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Neuropatiá motora y sensitiva sin atrofia' => [
                'valoration_laboral_column_first_motor_neuropathy' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Atrofia' => [
                'valoration_laboral_column_first_atrophy' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Axial' => [
                'valoration_laboral_cervical_column_axial' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Aumento de tono muscular' => [
                'valoration_laboral_cervical_column_more_tone' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Rigidez/limitación de movimientos' => [
                'valoration_laboral_cervical_column_rigidity' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Puntos gatillo' => [
                'valoration_laboral_cervical_column_triggers' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'ROMS Incompletos' => [
                'valoration_laboral_cervical_column_roms_incomplete' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Deformidad' => [
                'valoration_laboral_cervical_column_deformity' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Dolor' => [
                'valoration_laboral_cervical_column_pain' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Dolor + limitación' => [
                'valoration_laboral_cervical_column_pain_limitation' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            '' => [
                'valoration_laboral_cervical_column_nothing' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Posturas forzadas de cabeza' => [
                'valoration_laboral_cervical_column_head_forced' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Mantener la cabeza en la misma posición durante muchos minutos' => [
                'valoration_laboral_cervical_column_head_same_posture' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Movimientos repetitivos de la cabeza y brazos' => [
                'valoration_laboral_cervical_column_head_arms' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Aplicar fuerza con brazos y manos' => [
                'valoration_laboral_cervical_column_head_hands' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Tensión durante el trabajo' => [
                'valoration_laboral_cervical_column_tension_work' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
        ];
        $format = [];
        // Pregunta 1
        foreach ($valorationNames as $name => $evaluation) {
            $format[$name] = [];
            foreach ($evaluation as $section => $options) {
                foreach (array_slice($options, 1) as $type) {
                    if ($options['type'] == 'radio') {
                        $count = $this->_countRadiosDichotomic($section);
                        $format[$name][$type] = $count;
                    } else if ($options['type'] == 'checkbox') {
                        $count = $this->_countCheckboxes($section, $section, array_slice($options, 1));
                        $format[$name][$type] = $count;
                    }
                }
            }
        }
        if ($request->input('csv', false)) {
            $csvFile = tmpfile();
            $string = tmpfile();
            $string = "reactivo,valor," . PHP_EOL;
            foreach ($format as $categoryTitle => $category) {
                foreach ($category as $subCategoryTitle => $subCategory) {
                    if (is_numeric($subCategory)) {
                        //Title
                        $string = $string . "\"$categoryTitle...$subCategoryTitle\",";
                        $string = $string . "$subCategory";
                        $string = $string . PHP_EOL;
                        continue;
                    }
                    foreach ($subCategory as $laterality => $number) {
                        if (is_array($laterality)) {
                            dd($laterality);
                        }
                        $string = $string . "\"$categoryTitle...$subCategoryTitle...$laterality\",";
                        $string = $string . "$number,";
                        $string = $string . PHP_EOL;
                    }
                }
            }
            $headers = [
                'Content-type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="download.csv"',
            ];
            return \Response::make($string, 200, $headers);
        }
        return view('clinical_histories.nordic_printable')->with('format', $format);
    }

    /**
     * Sum values for the results of specific valoration for shoulder
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */

    public function _sumSpecificShoulder(Request $request)
    {
        $valorationNames = [
            'Neuropático' => [
                'valoration_laboral_shoulder_neuropatic' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Somático' => [
                'valoration_laboral_shoulder_somatic' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Inflamatorio' => [
                'valoration_laboral_shoulder_inflamatory' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'EVA' => [
                'valoration_laboral_shoulder_eva' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            // 'Tiempo de evolución' => [
            //     'valoration_laboral_shoulder_evolution'=>['type'=>'radio','Sí','No'],
            // ],
            'Dolor anterior hombro' => [
                'valoration_laboral_shoulder_anterior' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor al movimiento ABD FLEX' => [
                'valoration_laboral_shoulder_abd_flex' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor al movimiento RI/RE' => [
                'valoration_laboral_shoulder_ri_re' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor al movimiento AD/EXT' => [
                'valoration_laboral_shoulder_ad_ext' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Normal' => [
                'valoration_laboral_shoulder_normal' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Completos' => [
                'valoration_laboral_shoulder_complete' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Patte' => [
                'valoration_laboral_shoulder_patte' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Gerber' => [
                'valoration_laboral_shoulder_gerber' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Speed' => [
                'valoration_laboral_shoulder_speed' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Yergason' => [
                'valoration_laboral_shoulder_yergason' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor anterior hombro (2)' => [
                'valoration_laboral_shoulder_anterior_pain' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor al movimiento ABD FLEX (2)' => [
                'valoration_laboral_shoulder_fist_row_abd_flex' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor' => [
                'valoration_laboral_shoulder_fist_pain' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor/Limitación' => [
                'valoration_laboral_shoulder_fist_pain_limitation' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Capsulitis adhesiva' => [
                'valoration_laboral_shoulder_fist_adhesive_capsulitis' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolro a la abducción 70-120°' => [
                'valoration_laboral_shoulder_second_row_abduction70' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor en movimientos por encima de la cabeza' => [
                'valoration_laboral_shoulder_second_row_pain_overhead' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Arco doloroso' => [
                'valoration_laboral_shoulder_second_row_painful_arc' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Noer' => [
                'valoration_laboral_shoulder_second_row_noer' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Hawkins' => [
                'valoration_laboral_shoulder_second_hawkins' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Yocum' => [
                'valoration_laboral_shoulder_second_yocum' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'I/LEVE' => [
                'valoration_laboral_shoulder_second_1_soft' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'II/Moderado' => [
                'valoration_laboral_shoulder_second_2_moderate' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'III/Severo' => [
                'valoration_laboral_shoulder_second_3_severe' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Debilidad de 15-30°' => [
                'valoration_laboral_shoulder_third_warkness15' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor nocturno' => [
                'valoration_laboral_shoulder_third_nocturne_pain' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Jobe' => [
                'valoration_laboral_shoulder_third_jobe' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Brazo caído' => [
                'valoration_laboral_shoulder_fallen_arm' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Tendinosis' => [
                'valoration_laboral_shoulder_tendinosis' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Rotura parcial' => [
                'valoration_laboral_shoulder_partial_break' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Hombro' => [
                'valoration_laboral_shoulder_contracture_shoulder' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Deltoides' => [
                'valoration_laboral_shoulder_contracture_deltoid' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Trapecio' => [
                'valoration_laboral_shoulder_contracture_trapecy' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Manguito Rotador' => [
                'valoration_laboral_shoulder_contracture_manguito_rotador' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dorsal Ancho' => [
                'valoration_laboral_shoulder_contracture_dorsal' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Pectoral Mayor' => [
                'valoration_laboral_shoulder_contracture_pectoral' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Brazo' => [
                'valoration_laboral_shoulder_contracture_arm' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Biceps' => [
                'valoration_laboral_shoulder_contracture_biceps' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Triceps' => [
                'valoration_laboral_shoulder_contracture_triceps' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Supinador largo' => [
                'valoration_laboral_shoulder_contracture_long_supinator' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Braquial' => [
                'valoration_laboral_shoulder_contracture_braquial' => ['type' => 'radio', 'Sí', 'No'],
            ],
        ];
        $format = [];
        // Pregunta 1
        foreach ($valorationNames as $name => $evaluation) {
            $format[$name] = [];
            foreach ($evaluation as $section => $options) {
                foreach (array_slice($options, 1) as $type) {
                    if ($options['type'] == 'radio') {
                        $count = $this->_countRadiosDichotomic($section);
                        $format[$name][$type] = $count;
                    } else if ($options['type'] == 'checkbox') {
                        $count = $this->_countCheckboxes($section, $section, array_slice($options, 1));
                        $format[$name][$type] = $count;
                    }
                }
            }
        }
        if ($request->input('csv', false)) {
            $csvFile = tmpfile();
            $string = tmpfile();
            $string = "reactivo,valor," . PHP_EOL;
            foreach ($format as $categoryTitle => $category) {
                foreach ($category as $subCategoryTitle => $subCategory) {
                    if (is_numeric($subCategory)) {
                        //Title
                        $string = $string . "\"$categoryTitle...$subCategoryTitle\",";
                        $string = $string . "$subCategory";
                        $string = $string . PHP_EOL;
                        continue;
                    }
                    foreach ($subCategory as $laterality => $number) {
                        if (is_array($laterality)) {
                            dd($laterality);
                        }
                        $string = $string . "\"$categoryTitle...$subCategoryTitle...$laterality\",";
                        $string = $string . "$number,";
                        $string = $string . PHP_EOL;
                    }
                }
            }
            $headers = [
                'Content-type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="download.csv"',
            ];
            return \Response::make($string, 200, $headers);
        }
        return view('clinical_histories.nordic_printable')->with('format', $format);
    }

    /**
     * Sum values for the results of specific valoration for elbow
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */

    public function _sumSpecificElbow(Request $request)
    {
        $valorationNames = [
            'Neuropático' => [
                'valoration_laboral_elbow_neuropatic' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Somático' => [
                'valoration_laboral_elbow_somatic' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Inflamatorio' => [
                'valoration_laboral_elbow_inflamatory' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'EVA' => [
                'valoration_laboral_elbow_eva' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ],
            'Dolor en región lateral del codo' => [
                'valoration_laboral_elbow' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Aumento del dolor a la presión' => [
                'valoration_laboral_elbow' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Epicondilitis Crónica' => [
                'valoration_laboral_elbow' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Cozen' => [
                'valoration_laboral_elbow' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Milis' => [
                'valoration_laboral_elbow_first_line' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Silla' => [
                'valoration_laboral_elbow_first_line' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'I/Elongación' => [
                'valoration_laboral_elbow_first_line' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'II/Acción' => [
                'valoration_laboral_elbow_first_line' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'III/Reposo' => [
                'valoration_laboral_elbow_first_line' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Dolor en región medial del codo' => [
                'valoration_laboral_elbow_second_line' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Aumento de volumen/Tumefacción' => [
                'valoration_laboral_elbow_third_line' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Codo' => [
                'valoration_laboral_elbow_strength_elbow' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Flexores del carpo' => [
                'valoration_laboral_elbow_stength_carpian_flexors' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Extensores del carpo' => [
                'valoration_laboral_elbow_stength_carpian_extensors' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Biceps' => [
                'valoration_laboral_elbow_stength_biceps' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Triceps' => [
                'valoration_laboral_elbow_stength_triceps' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Supinador Largo' => [
                'valoration_laboral_elbow_stength_supinator' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Braquial' => [
                'valoration_laboral_elbow_stength_braquial' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Trabajo repetitivo haciendo fuerza con la mano y/o dedos' => [
                'valoration_laboral_elbow_repetitive_hand' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Trabajos que requieren movimientos de impacto o sacudidas, supinación o pronación repetidas del brazo contra resistencia así como movimientos de flexo-extensión forzada de la muñeca' => [
                'valoration_laboral_elbow_impact_hand' => ['type' => 'radio', 'Sí', 'No'],
            ],
            'Trabajos que requieren un apoyo prolongado sobre la cara posterior del codo' => [
                'valoration_laboral_elbow_prolonged_resting' => ['type' => 'radio', 'Sí', 'No'],
            ],
        ];
        $format = [];
        // Pregunta 1
        foreach ($valorationNames as $name => $evaluation) {
            $format[$name] = [];
            foreach ($evaluation as $section => $options) {
                foreach (array_slice($options, 1) as $type) {
                    if ($options['type'] == 'radio') {
                        $count = $this->_countRadiosDichotomic($section);
                        $format[$name][$type] = $count;
                    } else if ($options['type'] == 'checkbox') {
                        $count = $this->_countCheckboxes($section, $section, array_slice($values, 1));
                        $format[$name][$type] = $count;
                    }
                }
            }
        }
        if ($request->input('csv', false)) {
            $csvFile = tmpfile();
            $string = tmpfile();
            $string = "reactivo,valor," . PHP_EOL;
            foreach ($format as $categoryTitle => $category) {
                foreach ($category as $subCategoryTitle => $subCategory) {
                    if (is_numeric($subCategory)) {
                        //Title
                        $string = $string . "\"$categoryTitle...$subCategoryTitle\",";
                        $string = $string . "$subCategory";
                        $string = $string . PHP_EOL;
                        continue;
                    }
                    foreach ($subCategory as $laterality => $number) {
                        if (is_array($laterality)) {
                            dd($laterality);
                        }
                        $string = $string . "\"$categoryTitle...$subCategoryTitle...$laterality\",";
                        $string = $string . "$number,";
                        $string = $string . PHP_EOL;
                    }
                }
            }
            $headers = [
                'Content-type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="download.csv"',
            ];
            return \Response::make($string, 200, $headers);
        }
        return view('clinical_histories.nordic_printable')->with('format', $format);
    }

    /**
     * Sum values for the results of specific valoration for hand
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function _sumSpecificHand(Request $request)
    {
        $valorationNames = [
            'Dolor' => [
                'valoration_laboral_hand_pain_type' => ['type' => 'radio', 'Neuropático', 'Somático', 'Inflamatorio'],
                'valoration_laboral_hand_pain' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10']
            ],
            'Territorio Nervioso' => [
                'valoration_laboral_hand_time_evolution' => ['type' => 'radio', 'Mediano', 'Cubital', 'Radial']
            ],
            'Adormecimiento debilidad hormigueo' => [
                'valoration_laboral_hand_weakness' => ['type' => 'radio', 'Sí', 'No']
            ],
            '¿Nocturnos?' => [
                'valoration_laboral_hand_nocturne' => ['type' => 'radio', 'Sí', 'No']
            ],
            '¿Alivio de síntomas con cambios de posición?' => [
                'valoration_laboral_hand_relief_with_position' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Tinel' => [
                'valoration_laboral_hand_tinel' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Phalen' => [
                'valoration_laboral_hand_phalen' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Flick' => [
                'valoration_laboral_hand_flick' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Wartenberg' => [
                'valoration_laboral_hand_wartenberg' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Froment' => [
                'valoration_laboral_hand_froment' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Neuropatía Sensitiva' => [
                'valoration_laboral_hand_sensitive_neuropathies' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Sensitiva y Motora sin atrofia' => [
                'valoration_laboral_hand_sensitive_moter_no_atrophy' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Atrofia' => [
                'valoration_laboral_hand_atrophy' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Dolor en articulaciones IF, MCF' => [
                'valoration_laboral_hand_articulation_pain' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Inflamación articular' => [
                'valoration_laboral_hand_articular_inflammation' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Rigidez' => [
                'valoration_laboral_hand_rigidity' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Suma' => [
                'valoration_laboral_hand_sum' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Nódulos' => [
                'valoration_laboral_hand_nodules' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Deformidad' => [
                'valoration_laboral_hand_deformity' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Dolor+Inflamacioń' => [
                'valoration_laboral_hand_pain_inflammation' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Dolor en pulgar' => [
                'valoration_laboral_hand_thumb_pain' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Tumefacción dobre escafoides o trapecio' => [
                'valoration_laboral_hand_escafoids_trapecius_pain' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Filkenstein' => [
                'valoration_laboral_hand_filkenstein' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Calester' => [
                'valoration_laboral_hand_calester' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Dolor al estiramiento' => [
                'valoration_laboral_hand_pain_stretch' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Dolor ala acción' => [
                'valoration_laboral_hand_pain_action' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Dolor al reposo' => [
                'valoration_laboral_hand_pain_resting' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Trabajo repetitivo haciend o fuerza con la mano y/o dedos' => [
                'valoration_laboral_hand_pain_action_hand' => ['type' => 'radio', 'Sí', 'No']
            ],
            'Trabajo repetitivo forzado en muñeca, usando solo dos o tres dedos' => [
                'valoration_laboral_hand_pain_action_wrist' => ['type' => 'radio', 'Sí', 'No']
            ],
        ];
        $format = [];
        // Pregunta 1
        foreach ($valorationNames as $name => $evaluation) {
            $format[$name] = [];
            foreach ($evaluation as $section => $options) {
                foreach (array_slice($options, 1) as $type) {
                    if ($options['type'] == 'radio') {
                        $count = $this->_countRadiosDichotomic($section);
                        $format[$name][$type] = $count;
                    } else if ($options['type'] == 'checkbox') {
                        $count = $this->_countCheckboxes($section, $section, array_slice($values, 1));
                        $format[$name][$type] = $count;
                    }
                }
            }
        }
        if ($request->input('csv', false)) {
            $csvFile = tmpfile();
            $string = tmpfile();
            $string = "reactivo,valor," . PHP_EOL;
            foreach ($format as $categoryTitle => $category) {
                foreach ($category as $subCategoryTitle => $subCategory) {
                    if (is_numeric($subCategory)) {
                        //Title
                        $string = $string . "\"$categoryTitle...$subCategoryTitle\",";
                        $string = $string . "$subCategory";
                        $string = $string . PHP_EOL;
                        continue;
                    }
                    foreach ($subCategory as $laterality => $number) {
                        if (is_array($laterality)) {
                            dd($laterality);
                        }
                        $string = $string . "\"$categoryTitle...$subCategoryTitle...$laterality\",";
                        $string = $string . "$number,";
                        $string = $string . PHP_EOL;
                    }
                }
            }
            $headers = [
                'Content-type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="download.csv"',
            ];
            return \Response::make($string, 200, $headers);
        }
        return view('clinical_histories.nordic_printable')->with('format', $format);
    }

    /**
     * Sum values for the results of specific valoration for nordic evaluation
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function _sumNordic(Request $request)
    {
        $body_parts = [
            'Cuello' => ['type' => 'radio', 'Sí', 'No'],
            'Hombro' => ['type' => 'checkbox', 'Izq', 'Der', 'Ambos', 'No'],
            'Dorsal o Lumbar' => ['type' => 'radio', 'Sí', 'No'],
            'Codo o Antebrazo' => ['type' => 'checkbox', 'Izq', 'Der', 'Ambos', 'No'],
            'Muñeca o manos' => ['type' => 'checkbox', 'Izq', 'Der', 'Ambos', 'No'],
        ];
        $body_parts_dichotomic = [
            'Cuello' => ['type' => 'radio', 'Sí', 'No'],
            'Hombro' => ['type' => 'radio', 'Sí', 'No'],
            'Dorsal o Lumbar' => ['type' => 'radio', 'Sí', 'No'],
            'Codo o Antebrazo' => ['type' => 'radio', 'Sí', 'No'],
            'Muñeca o manos' => ['type' => 'radio', 'Sí', 'No'],
        ];
        $body_parts_1_to_5 = [
            'Cuello' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Hombro' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Espalda (dorsal)' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Espalda (lumbar)' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Brazo' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Codo' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Antebrazo' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Muñeca o manos' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Pierna' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Rodilla' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Pantorrilla' => ['type' => 'radio', '1', '2', '3', '4', '5'],
            'Pie' => ['type' => 'radio', '1', '2', '3', '4', '5'],
        ];
        $body_parts_for_12_months = [
            'Cuello' => ['type' => 'radio', '1 a 7 días', '8 a 30 días', '>30 días no seguidos', 'Siempre'],
            'Hombro' => ['type' => 'radio', '1 a 7 días', '8 a 30 días', '>30 días no seguidos', 'Siempre'],
            'Dorsal o Lumbar' => ['type' => 'radio', '1 a 7 días', '8 a 30 días', '>30 días no seguidos', 'Siempre'],
            'Codo o Antebrazo' => ['type' => 'radio', '1 a 7 días', '8 a 30 días', '>30 días no seguidos', 'Siempre'],
            'Muñeca o manos' => ['type' => 'radio', '1 a 7 días', '8 a 30 días', '>30 días no seguidos', 'Siempre'],
        ];
        $body_parts_pain_episode_duration = [
            'Cuello' => ['type' => 'radio', '<1hr', '1-24hrs', '1-7 días', '1-4 semanas', '>1 mes'],
            'Hombro' => ['type' => 'radio', '<1hr', '1-24hrs', '1-7 días', '1-4 semanas', '>1 mes'],
            'Dorsal o Lumbar' => ['type' => 'radio', '<1hr', '1-24hrs', '1-7 días', '1-4 semanas', '>1 mes'],
            'Codo o Antebrazo' => ['type' => 'radio', '<1hr', '1-24hrs', '1-7 días', '1-4 semanas', '>1 mes'],
            'Muñeca o manos' => ['type' => 'radio', '<1hr', '1-24hrs', '1-7 días', '1-4 semanas', '>1 mes'],
        ];
        $body_parts_incapacitation_from_work_duration = [
            'Cuello' => ['type' => 'radio', 'Nunca', '1-7 días', '1 a 4 semanas', '>1 mes'],
            'Hombro' => ['type' => 'radio', 'Nunca', '1-7 días', '1 a 4 semanas', '>1 mes'],
            'Dorsal o Lumbar' => ['type' => 'radio', 'Nunca', '1-7 días', '1 a 4 semanas', '>1 mes'],
            'Codo o Antebrazo' => ['type' => 'radio', 'Nunca', '1-7 días', '1 a 4 semanas', '>1 mes'],
            'Muñeca o manos' => ['type' => 'radio', 'Nunca', '1-7 días', '1 a 4 semanas', '>1 mes'],
        ];
        $format = [];
        // Pregunta 1
        $format["1.-Has tenido molestias en:"] = [];
        foreach ($body_parts as $bodyPart => $values) {
            $lowerBodyPart = strtolower($bodyPart);
            if ($values['type'] == 'radio') {
                $count = $this->_countRadiosDichotomic("valoration_tendons_and_muscle_nordic_$bodyPart");
                $format["1.-Has tenido molestias en:"][$bodyPart] = $count;
            } else if ($values['type'] == 'checkbox') {
                $count = $this->_countCheckboxes("valoration_tendons_and_muscle_nordic_$bodyPart", $bodyPart, ['Izq', 'Der', 'Ambos', 'No']);
                $format["1.-Has tenido molestias en:"][$bodyPart] = $count;
            }
        }
        // TODO pregunta 2
        // Pregunta 3
        $format["3.- Has necesitado cambiar de puesto de trabajo:"] = [];
        foreach ($body_parts_dichotomic as $bodyPart => $values) {
            $lowerBodyPart = strtolower($bodyPart);
            if ($values['type'] == 'radio') {
                $count = $this->_countRadiosDichotomic("valoration_tendons_and_muscle_nordic_change_in_job_$bodyPart");
                $format["3.- Has necesitado cambiar de puesto de trabajo:"][$bodyPart] = $count;
            } else if ($values['type'] == 'checkbox') {
                $count = $this->_countCheckboxes("valoration_tendons_and_muscle_nordic_change_in_job_$bodyPart", $bodyPart, ['Izq', 'Der', 'Ambos', 'No']);
                $format["3.- Has necesitado cambiar de puesto de trabajo:"][$bodyPart] = $count;
            }
        }
        // Pregunta 4
        $format["4.- ¿Ha tenido molestias en los últimos 12 meses en...?"] = [];
        foreach ($body_parts_dichotomic as $bodyPart => $values) {
            $lowerBodyPart = strtolower($bodyPart);
            if ($values['type'] == 'radio') {
                $count = $this->_countRadiosDichotomic("valoration_tendons_and_muscle_nordic_complained_lately_about_$bodyPart");
                $format["4.- ¿Ha tenido molestias en los últimos 12 meses en...?"][$bodyPart] = $count;
            } else if ($values['type'] == 'checkbox') {
                $count = $this->_countCheckboxes("valoration_tendons_and_muscle_nordic_complained_lately_about_$bodyPart", $bodyPart, ['Izq', 'Der', 'Ambos', 'No']);
                $format["4.- ¿Ha tenido molestias en los últimos 12 meses en...?"][$bodyPart] = $count;
            }
        }
        // Pregunta 5
        $format["5.- ¿Cuanto tiempo ha tenido molestias en los ultimos 12 meses en...?"] = [];
        foreach ($body_parts_for_12_months as $bodyPart => $values) {
            $lowerBodyPart = strtolower($bodyPart);
            if ($values['type'] == 'radio') {
                $count = $this->_countRadiosOptions("valoration_tendons_and_muscle_nordic_complained_last_12_months_$bodyPart", $bodyPart, [
                    "$bodyPart de 1 a 7 días",
                    "$bodyPart de 8 a 30 días",
                    "$bodyPart de >30 días no seguidos",
                    "$bodyPart de Siempre"
                ]);
                $format["5.- ¿Cuanto tiempo ha tenido molestias en los ultimos 12 meses en...?"][$bodyPart] = $count;
            }
        }
        // Pregunta 6
        $format["6.- ¿Cuanto dura cada episodio de molestia en...?"] = [];
        foreach ($body_parts_pain_episode_duration as $bodyPart => $values) {
            $lowerBodyPart = strtolower($bodyPart);
            if ($values['type'] == 'radio') {
                $count = $this->_countRadiosOptions("valoration_tendons_and_muscle_nordic_pain_episode_duration_$bodyPart", $bodyPart, [
                    "$bodyPart < 1h",
                    "$bodyPart 1-24hrs",
                    "$bodyPart 1-7 días",
                    "$bodyPart 1-4 semanas",
                    "$bodyPart > 1 mes"
                ]);
                $format["6.- ¿Cuanto dura cada episodio de molestia en...?"][$bodyPart] = $count;
            }
        }
        // Pregunta 7
        $format["7.- ¿Cuanto tiempo estas molestias le han impedido hacer su trabajo en los últimos meses?"] = [];
        foreach ($body_parts_pain_episode_duration as $bodyPart => $values) {
            $lowerBodyPart = strtolower($bodyPart);
            if ($values['type'] == 'radio') {
                $count = $this->_countRadiosOptions("valoration_tendons_and_muscle_nordic_incapacitation_from_work_duration_$bodyPart", $bodyPart, [
                    "$bodyPart < 1h",
                    "$bodyPart 1-24hrs",
                    "$bodyPart 1-7 días",
                    "$bodyPart 1-4 semanas",
                    "$bodyPart > 1 mes"
                ]);
                $format["7.- ¿Cuanto tiempo estas molestias le han impedido hacer su trabajo en los últimos meses?"][$bodyPart] = $count;
            }
        }
        // Pregunta 8
        $format["8.- ¿Has recibido tratamiento por estas mokestias los últimos 12 meses?"] = [];
        foreach ($body_parts_dichotomic as $bodyPart => $values) {
            $lowerBodyPart = strtolower($bodyPart);
            if ($values['type'] == 'radio') {
                $count = $this->_countRadiosDichotomic("valoration_tendons_and_muscle_nordic_received_treatment_$bodyPart");
                $format["8.- ¿Has recibido tratamiento por estas mokestias los últimos 12 meses?"][$bodyPart] = $count;
            }
        }
        // Pregunta 9
        $format["9.- ¿Ha tenido molestias en los últimos 7 días?"] = [];
        foreach ($body_parts_dichotomic as $bodyPart => $values) {
            $lowerBodyPart = strtolower($bodyPart);
            if ($values['type'] == 'radio') {
                $count = $this->_countRadiosDichotomic("valoration_tendons_and_muscle_nordic_pain_7_days_prior_$bodyPart");
                $format["9.- ¿Ha tenido molestias en los últimos 7 días?"][$bodyPart] = $count;
            }
        }
        // Pregunta 10
        $format["10.- ¿Califique las molestias del 1 al 5, siendo 1 una molestia mínima y 5 molestias muy fuertes?"] = [];
        foreach ($body_parts_1_to_5 as $bodyPart => $values) {
            $lowerBodyPart = strtolower($bodyPart);
            if ($values['type'] == 'radio') {
                $labels = [];
                foreach (range(1, 5) as $grade) {
                    $labels[] = "$bodyPart $grade";
                }
                $count = $this->_countRadiosOptions("valoration_tendons_and_muscle_nordic_pain_evaluation_1_to_5_$bodyPart", $bodyPart, $labels);
                $format["10.- ¿Califique las molestias del 1 al 5, siendo 1 una molestia mínima y 5 molestias muy fuertes?"][$bodyPart] = $count;
            }
        }
        // TODO 11
        // Pregunta 12
        $format["12.- Zonas de dolor y comentarios libres:"] = [];
        $bodyPart = 'Zonas de Dolor';
        $labels = [];
        foreach (range(1, 12) as $zone) {
            $labels[] = "Zona $zone";
        }
        $count = $this->_countCheckboxes("valoration_tendons_and_muscle_nordic_pain_evaluation_1_to_12_", 'Zonas de Dolor', $labels);
        $format["12.- Zonas de dolor y comentarios libres:"]['Zonas de Dolor'] = $count;
        if ($request->input('csv', false)) {
            $csvFile = tmpfile();
            $string = tmpfile();
            $string = "reactivo,valor," . PHP_EOL;
            foreach ($format as $categoryTitle => $category) {
                foreach ($category as $subCategoryTitle => $subCategory) {
                    if (is_numeric($subCategory)) {
                        //Title
                        $string = $string . "\"$categoryTitle...$subCategoryTitle\",";
                        $string = $string . "$subCategory";
                        $string = $string . PHP_EOL;
                        continue;
                    }
                    foreach ($subCategory as $laterality => $number) {
                        if (is_array($laterality)) {
                            dd($laterality);
                        }
                        $string = $string . "\"$categoryTitle...$subCategoryTitle...$laterality\",";
                        $string = $string . "$number,";
                        $string = $string . PHP_EOL;
                    }
                }
            }
            $headers = [
                'Content-type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="download.csv"',
            ];
            return \Response::make($string, 200, $headers);
        }
        return view('clinical_histories.nordic_printable')->with('format', $format);
    }

    /**
     * Helper function to count checkboxes
     * @param $section
     * @param $bodyPart
     * @param $options
     * @return array
     */

    private function _countCheckboxes($section, $bodyPart, $options)
    {
        if ("valoration_tendons_and_muscle_nordic_pain_evaluation_1_to_12" == $section) {
            dd('hi');
        }
        $lowerSection = strtolower($section);

        $checkboxes = \DB::table('valorations')->selectRaw('*')
            ->whereRaw("id IN (
                SELECT MAX(v.id) as id
                FROM valorations as v
                LEFT OUTER JOIN clinical_histories as  ch ON v.clinical_history_id = ch.id
                LEFT OUTER JOIN patients as p ON p.id= ch.patient_id
                LEFT OUTER JOIN job_analysis as ja ON ja.patient_id = p.id
                LEFT OUTER JOIN workspaces as w ON w.id = ja.workspace_id
                LEFT OUTER JOIN laboral_companies as lc ON lc.id = w.laboral_company_id
                WHERE v.section='$section'
                    OR v.section='$lowerSection'
                GROUP BY v.clinical_history_id
            )")
            ->get();
        $responseArray = [];
        array_walk($options, function ($element) use (&$responseArray) {
            $responseArray[$element] = 0;
        });
        $checkboxes->each(function ($question) use ($bodyPart, &$responseArray, $options) {
            $decode = json_decode($question->json_values);
            // dd($decode);
            if (!is_array($decode)) {
                $decode = (array) $decode;
            }
            foreach ($options as $key => $option) {
                $responseArray[$option] = !empty($decode[$key]) ? $responseArray[$option] + 1 : $responseArray[$option];
            }
        });
        return $responseArray;

    }

    /**
     * Helper function to count radios
     * @param $section
     * @return mixed
     */

    private function _countRadiosDichotomic($section)
    {
        $lowerSection = strtolower($section);
        $laboralCompanyId = request()->input('laboral_company_id', 0);
        return \DB::table('valorations')->selectRaw('*')
            ->whereRaw("id IN (
                SELECT MAX(v.id) as id
                FROM valorations as v
                LEFT OUTER JOIN clinical_histories as  ch ON v.clinical_history_id = ch.id
                LEFT OUTER JOIN patients as p ON p.id= ch.patient_id
                LEFT OUTER JOIN job_analysis as ja ON ja.patient_id = p.id
                LEFT OUTER JOIN workspaces as w ON w.id = ja.workspace_id
                LEFT OUTER JOIN laboral_companies as lc ON lc.id = w.laboral_company_id
                WHERE (v.section='$section'
                    OR v.section='$lowerSection')
                    AND v.json_values=''
                    AND lc.id = $laboralCompanyId
                GROUP BY v.clinical_history_id
            )")
            ->get()->count();
    }

    /**
     * Helper function to count radios that are not dicotomic but numeric
     * @param $section
     * @param $bodyPart
     * @param $options
     * @return array
     */

    private function _countRadiosNumeric($section, $bodyPart, $startInt, $endInt)
    {
        $arrayNumbers = range($startInt - 1, $endInt - 1);
        $lowerSection = strtolower($section);
        $laboralCompanyId = request()->input('laboral_company_id', 0);
        $radios = \DB::table('valorations')->selectRaw('*')
            ->whereRaw("id IN (
                SELECT MAX(id) as id
                FROM valorations as v
                RIGHT JOIN patients as p ON v.patient_id = p.id
                RIGHT JOIN job_analysis ja as p ON ja.patient_id = p.id
                RIGHT JOIN workspaces w as p ON w.id = ja.workspace_id
                RIGHT JOIN laboral_companies as lc ON lc.id = w.laboral_company_id
                WHERE (section='$section'
                    OR section='$lowerSection')
                    AND (lc.id = )
                GROUP BY clinical_history_id
            )")
            ->get();
        $responseArray = [];
        array_walk($arrayNumbers, function ($element) use (&$responseArray) {
            $responseArray[$element] = 0;
        });
        $radios->each(function ($question) use ($bodyPart, &$responseArray, $arrayNumbers) {
            $decode = json_decode($question->json_values);
            // dd($decode);
            if (!is_array($decode)) {
                $decode = (array) $decode;
            }
            foreach ($arrayNumbers as $key => $option) {
                $responseArray[$option] = !empty($decode[$key]) ? $responseArray[$option] + 1 : $responseArray[$option];
            }
        });
        return $responseArray;
    }

    /**
     * Helper function to count radios that are not dicotomic and are not numeric (qualitative)
     * @param $section
     * @param $bodyPart
     * @param $options
     * @return array
     */

    private function _countRadiosOptions($section, $bodyPart, $options)
    {
        $lowerSection = strtolower($section);
        $laboralCompanyId = request()->input('laboral_company_id', 0);
        $radios = \DB::table('valorations')->selectRaw('*')
            ->whereRaw("id IN (
                SELECT MAX(v.id) as id
                FROM valorations as v
                LEFT OUTER JOIN clinical_histories as  ch ON v.clinical_history_id = ch.id
                LEFT OUTER JOIN patients as p ON p.id= ch.patient_id
                LEFT OUTER JOIN job_analysis as ja ON ja.patient_id = p.id
                LEFT OUTER JOIN workspaces as w ON w.id = ja.workspace_id
                LEFT OUTER JOIN laboral_companies as lc ON lc.id = w.laboral_company_id
                WHERE v.section='$section'
                    OR v.section='$lowerSection'
                    AND lc.id = $laboralCompanyId
                GROUP BY v.clinical_history_id
            )")
            ->get();
        $responseArray = [];
        array_walk($options, function ($element) use ($bodyPart, &$responseArray) {
            $responseArray[$element] = 0;
        });
        $radios->each(function ($question) use ($bodyPart, &$responseArray) {
            $value = $question->json_values;
            $value = ($value === "") ? 0 : $value;

            foreach (array_keys($responseArray) as $key => $option) {
                if (!$bodyPart)
                    continue;
                $responseArray[$option] = !empty(is_numeric($value)) && $key == $value ? $responseArray[$option] + 1 : $responseArray[$option];
            }
        });
        return $responseArray;
    }
}
