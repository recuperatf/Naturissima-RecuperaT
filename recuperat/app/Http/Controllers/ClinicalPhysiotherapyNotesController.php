<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\ClinicalHistory;
use App\Patient;
use App\Valoration;
use App\Decision;
use App\Laboratorio;
use App\ClinicalPhysiotherapyNote;
use Illuminate\Http\Request;
use Auth;
use Str;
use Illuminate\Support\Facades\Cache;

class ClinicalPhysiotherapyNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $stop_extend = false)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClinicalHistory  $clinicalHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ClinicalHistory $clinicalHistory)
    {
        //
    }

    public function store(Request $request)
    {
        $allRequest = $request->all();
        unset($allRequest['file']);
        unset($allRequest['_token']);
        unset($allRequest[$allRequest['patient_id']]);

        ClinicalPhysiotherapyNote::create([
            'clinical_history_id' => $allRequest['clinicalHistoryId'],
            'json_values' => json_encode($allRequest),
            'author_id' => Auth::id()
        ]);
        $patient = Patient::find($request->input('patient_id'));
        $patient->responsible_id = Auth::id();
        $patient->save();
        return redirect(route('pacientes.index'))->with('modifiedSuccess', 'Historia Modificada');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClinicalHistory  $clinicalHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ClinicalPhysiotherapyNote $clinicalPhysiotherapyNote)
    {
        $clinicalHistory = ClinicalHistory::find($clinicalPhysiotherapyNote->clinical_history_id);
        $patient = $clinicalHistory->patient;
        $allFiles = $this->_allFiles($patient->id);
        $valorationsObject = json_decode($clinicalPhysiotherapyNote->json_values);
        $valorationsObjectKeys = get_object_vars($valorationsObject);
        $valorationsCollection = collect([]);
        foreach ($valorationsObjectKeys as $valorationName => $content) {
            $objectArray = ((array) $valorationsObject->$valorationName);
            if (!sizeof($objectArray) > 0)
                continue;
            foreach ($objectArray as $object) {
                $valorationsCollection->push($object);
            }
        }
        return view('clinical_histories.clinical_note_physiotherapy')->with('patient_id', !empty($patient) ? $patient->id : false)->
            with('patient', $patient)->
            with('files', $allFiles)->
            with('clinicalPhysiotherapyNote', $clinicalPhysiotherapyNote)->
            with('antecedents', $valorationsCollection)->
            with('valorations', $valorationsCollection)->
            with('lastNote', $clinicalPhysiotherapyNote->last_note)->
            with('nextNote', $clinicalPhysiotherapyNote->next_note)->
            with('clinicalHistory', $clinicalHistory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClinicalHistory  $clinicalHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClinicalPhysiotherapyNote $clinicalPhysiotherapyNote)
    {
        $allRequest = $request->all();
        unset($allRequest['file']);
        unset($allRequest['_token']);
        unset($allRequest[$allRequest['patient_id']]);
        $clinicalPhysiotherapyNote->clinical_history_id = $allRequest['clinicalHistoryId'];
        $clinicalPhysiotherapyNote->json_values = json_encode($allRequest);
        $clinicalPhysiotherapyNote->author_id = Auth::id();
        $clinicalPhysiotherapyNote->save();
        return redirect(route('pacientes.index'))->with('modifiedSuccess', 'Historia Modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClinicalHistory  $clinicalHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClinicalHistory $clinicalHistory)
    {
        //
    }

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
        $decisions = Decision::with('home_physiotherapy_programs')->where('patient_id', $patient->id)->get()->toArray();
        $decisions = array_map(function ($element) {
            $element['user'] = \App\User::find($element['user_id']);
            $element['patient'] = \App\Patient::find($element['patient_id']);
            return $element;
        }, $decisions);
        $clinics = \App\Clinic::all();
        return view('clinical_histories.clinical_decision')
            ->with('patient', $patient)
            ->with('user', Auth::user())
            ->with('clinics', $clinics)
            ->with('json_decisions', json_encode($decisions))
            ->with('img', $img);
    }

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

    public function valorationDelete(Request $request, $updated_at)
    {
        $parsedUpdatedAt = str_replace('T', ' ', $updated_at);
        $valorations = \DB::table('valorations')
            ->where('updated_at', str_replace('T', ' ', $parsedUpdatedAt))
            ->delete();
        return $valorations;
    }

    public function allFiles(Request $request, $patientId)
    {
        // return [];
        return $this->_allFiles($patientId);
    }

    private function _allFiles($patientId)
    {
        // return [];
        $files = $this->_findMetadataByName("${patientId}_clinical_history_", true);
        return $files;
    }

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

    public function removeFile(Request $request, $path)
    {
        \Storage::disk('google')->delete($path);
        return response('success');
    }

    public function downloadFile(Request $request, $fileId)
    {
        return \Storage::disk('google')->download($fileId);
    }

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

    public function _sumSpecificHand(Request $request)
    {
        dd('hi');
        $valorationNames = [
            'Dolor' => [
                'valoration_laboral_hand_pain_type' => ['type' => 'radio', 'Neuropático', 'Somático', 'Inflamatorio'],
                'valoration_laboral_hand_pain' => ['type' => 'radio', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10']
            ],
            'Territorio Nervioso' => [
                'valoration_laboral_hand_time_evolution' => ['type' => 'radio', 'Mediano', 'Cubital', 'Radial']
            ]
        ];
        $format = [];
        // Pregunta 1
        foreach ($valorationNames as $name => $evaluation) {
            $format[$name] = [];
            foreach ($evaluation as $section => $options) {
                foreach (array_slice($options, 1) as $type) {
                    if ($options['type'] == 'radio') {
                        $count = $this->_countRadiosDichotomic($name);
                        $format[$name][$type] = $count;
                    } else if ($options['type'] == 'checkbox') {
                        $count = $this->_countCheckboxes($name, $name, array_slice($values, 1));
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
