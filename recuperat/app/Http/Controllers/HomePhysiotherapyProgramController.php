<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Traits\ProduceImageFromBase64;
use \App\ImageResource;
use \App\HomePhysiotherapyProgram;
use \App\Exercise;
use \App\Prescription;
use \App\Massage;
use \App\PhysicalAgent;
use \App\Contraindication;
use \App\User;
use \App\ExcerciseDivision;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Storage;

class HomePhysiotherapyProgramController extends CRUDController
{
    use ProduceImageFromBase64;
    public function __construct(array $attributes = array())
    {
        parent::__construct();
        $this->index_search_fields = array(
            'name',
            'keywords'
        );
        $this->route_show = 'decision.show';
        $this->permissions = [
            'create' => 'home_fisiotherapy_program.create',
            'edit' => 'home_fisiotherapy_program.edit',
            'delete' => 'home_fisiotherapy_program.delete'
        ];
        $this->route_path = 'home_physiotherapy_program';
        $this->class_name = '\App\HomePhysiotherapyProgramController';
        $this->model_name = '\App\HomePhysiotherapyProgram';
        $this->short_model_name = 'HomePhysiotherapyProgram';
        // $this->file_output = 'images/plans_images/diagnosis/';
        $this->A_validator = [
            'name' => 'required',
        ];
        $this->A_validator_messages = [
            'name.required' => 'El campo de nombre es obligatorio',
        ];
        $this->relationships = [
            'sintomas',
            'clinic_diagnosis',
            'radiologic_diagnosis',
            'treatments',
            'keywords',
            'anato_physiology_glosary_item',
        ];
        $this->file_relationships = [

        ];
        $this->keys = [
            'index' => [
                'name' => 'Nombre',
                'user_id.filter' => 'Usuario',
                'is_sealed_text' => 'Sellado',
            ],
            'user_id' => true,
            'create' => [
                ['key' => 'name', 'label' => 'Nombre', 'type' => 'text'],
                ['key' => 'code', 'label' => 'Clave', 'type' => 'text'],
                'keywords' => [
                    'single' => false,
                    'addRoute' => 'keywords.create',
                    'key' => 'keywords',
                    'label' => 'Palabras Clave',
                    'type' => 'autocompletable_multiple',
                    'class' => 'autocompletable_cie10_lesions',
                    'name' => 'keywords',
                    'url' => 'keywords/ajaxGet'
                ],
            ]
        ];
    }

    public function newVersion($id)
    {
        $terapeuticPlan = HomePhysiotherapyProgram::find($id);
        $newTerapeuticPlan = $terapeuticPlan->replicate();
        $newTerapeuticPlan->is_sealed = false;
        $newTerapeuticPlan->name = $newTerapeuticPlan->name . "($newTerapeuticPlan->id)";
        $newTerapeuticPlan->save();
        return redirect(route('home_physiotherapy_program.edit', $newTerapeuticPlan->id));
    }

    public function create()
    {
        return view('valorations.create_home_physiotherapy_program_catalog')->
            with('valorations', [])
            ->with('newVersionRoute', $this->route_path ? $this->route_path . '.new_version' : null)
            ->with('useVue', true);
    }
    public function apiIndex(Request $request)
    {
        return HomePhysiotherapyProgram::all();
    }
    public function apiSearch(Request $request, $string)
    {
        $col = HomePhysiotherapyProgram::where("name", "like", "%")->limit(20)->orderBy('name', 'asc')->get();
        if ($string) {
            $col = HomePhysiotherapyProgram::where("name", "like", "%" . $string . "%")->orWhere('id', 'like', '%' . $string . '%')->limit(20)->orderBy('name', 'asc')->get();
        }
        return $col->map(
            function ($hfp) {
                return [
                    'id' => $hfp->id,
                    'label' => $hfp->name
                ];
            }
        );
        return $col->pluck('name', 'id')->toArray();
    }
    public function apiShow(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        header("Access-Control-Allow-Origin: *");
        $homePhysiotherapyProgram = $hpfId
            ->with('exercise.image_resources')
            ->with('exercise.video_links')
            ->with('massage.image_resources')
            ->with('physical_agent.image_resources')
            ->with('prescription.image_resources')
            ->with('contraindication')
            ->with('keywords')
            ->with('anato_physiology_glosary_item')
            ->find($hpfId->id);
        $homePhysiotherapyProgram->append('exercise_divisions');
        return $homePhysiotherapyProgram;
    }

    public function apiCreate(Request $request)
    {
        $homePhysiotherapyProgram = new HomePhysiotherapyProgram();
        $homePhysiotherapyProgram->fill($request->all());
        $homePhysiotherapyProgram->json_values = '';
        $homePhysiotherapyProgram->user_id = User::first()->id;
        $homePhysiotherapyProgram->save();
        return response($homePhysiotherapyProgram, 200);
    }

    public function apiCreateExercise(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        unset($aRequest['pivot']);
        unset($aRequest['image_resources']);
        unset($aRequest['series']);
        unset($aRequest['repetitions']);
        unset($aRequest['video_links']);
        $exercise = new Exercise();
        $exercise->fill($aRequest);
        $exercise->save();
        foreach ($request->video_links as $videoLink) {
            $videoLink = new \App\VideoLink(['name' => $videoLink]);
            $exercise->video_links()->save($videoLink);
        }
        $base64Files = !empty ($request->imageFiles) ? $request->imageFiles : [];
        $this->_addImages($base64Files, $exercise);
        $hpfId->exercise()->save($exercise);
        $hpfId->exercise()->syncWithoutDetaching(
            [
                $exercise->id => [
                    'series' => $request->series,
                    'repetitions' => $request->repetitions,
                ]
            ]
        );
        $exercise = $hpfId->exercise->load('image_resources', 'video_links')->find($exercise->id);
        return response($exercise, 200);
    }

    public function apiUpdateExercise(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        $exercise = Exercise::find($request->id);
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        unset($aRequest['pivot']);
        unset($aRequest['image_resources']);
        unset($aRequest['exercise_division']);
        unset($aRequest['series']);
        unset($aRequest['repetitions']);
        unset($aRequest['video_links']);
        $exercise->fill($aRequest);
        $exercise->save();
        $base64Files = !empty ($request->imageFiles) ? $request->imageFiles : [];
        $this->_addImages($base64Files, $exercise);
        $hpfId->exercise()->syncWithoutDetaching(
            [
                $exercise->id => [
                    'series' => $request->pivot['series'],
                    'repetitions' => $request->pivot['repetitions'],
                ]
            ]
        );
        $exercise = $hpfId->exercise->load('image_resources')->find($request->id);
        return response($exercise, 200);
    }

    public function apiGetExercise(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        return $hpfId
            ->with('exercise.image_resources')
            ->first()
            ->exercise;
    }

    public function apiDeleteExerciseResourceImage(Request $request, HomePhysiotherapyProgram $hpfId, Exercise $exercise, ImageResource $imageResource)
    {
        $imageResource->delete();
        $exercise = $hpfId->exercise->load('image_resources')->find($exercise->id);
        return $hpfId
            ->with('exercise.image_resources')
            ->first()
            ->exercise;
    }

    public function apiDeleteExercise(Request $request, HomePhysiotherapyProgram $hpfId, Exercise $exercise)
    {
        $hpfId->exercise()->detach($exercise);
        return $hpfId
            ->with('exercise.image_resources')
            ->where('id', $hpfId->id)
            ->first()
            ->exercise;
    }

    public function apiCreateMassage(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        unset($aRequest['pivot']);
        unset($aRequest['description']);
        unset($aRequest['image_resources']);
        $massage = new Massage();
        $massage->fill($aRequest);
        $massage->save();
        $base64Files = !empty ($request->imageFiles) ? $request->imageFiles : [];
        $this->_addImages($base64Files, $massage);
        $hpfId->massage()->save($massage);
        $massage = $hpfId->massage->load('image_resources')->find($massage->id);
        return response($massage, 200);
    }

    public function apiDeleteMassage(Request $request, HomePhysiotherapyProgram $hpfId, Massage $massage)
    {
        $hpfId->massage()->detach($massage);
        return $hpfId
            ->with('massage.image_resources')
            ->where('id', $hpfId->id)
            ->first()
            ->massage;
    }

    public function apiUpdateMassage(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        unset($aRequest['pivot']);
        unset($aRequest['description']);
        unset($aRequest['image_resources']);
        $massage = Massage::find($request->id);
        $massage->fill($aRequest);
        $massage->save();
        $base64Files = !empty ($request->imageFiles) ? $request->imageFiles : [];
        $this->_addImages($base64Files, $massage);
        $massage = $hpfId->massage->load('image_resources')->find($request->id);
        return response($massage, 200);
    }

    public function apiDeleteMassageResourceImage(Request $request, HomePhysiotherapyProgram $hpfId, Massage $massage, ImageResource $imageResource)
    {
        $imageResource->delete();
        $massage = $hpfId->massage->load('image_resources')->find($massage->id);
        return response($massage, 200);
    }

    public function apiCreatePhysicalAgent(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        unset($aRequest['image_resources']);
        unset($aRequest['pivot']);
        unset($aRequest['indication']);
        unset($aRequest['precautions']);
        $physical_agent = new PhysicalAgent();
        $physical_agent->fill($aRequest);
        $physical_agent->save();
        $base64Files = !empty ($request->imageFiles) ? $request->imageFiles : [];
        $this->_addImages($base64Files, $physical_agent);
        $hpfId->physical_agent()->save($physical_agent);
        $hpfId->physical_agent()->syncWithoutDetaching(
            [
                $physical_agent->id => [
                    'indication' => $request->indication,
                    'precautions' => $request->precautions,
                ]
            ]
        );
        $physical_agent = $hpfId->physical_agent->load('image_resources')->find($physical_agent->id);
        return response($physical_agent, 200);
    }

    public function apiUpdatePhysicalAgent(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        $physical_agent = PhysicalAgent::find($request->id);
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        unset($aRequest['image_resources']);
        unset($aRequest['pivot']);
        unset($aRequest['indication']);
        unset($aRequest['precautions']);
        $physical_agent->fill($aRequest);
        $physical_agent->save();
        $base64Files = !empty ($request->imageFiles) ? $request->imageFiles : [];
        $this->_addImages($base64Files, $physical_agent);
        $hpfId->physical_agent()->syncWithoutDetaching(
            [
                $physical_agent->id => [
                    'indication' => $request->pivot['indication'],
                    'precautions' => $request->pivot['precautions'],
                ]
            ]
        );
        $physical_agent = $hpfId->physical_agent->load('image_resources')->find($request->id);
        return response($physical_agent, 200);
    }

    public function apiDeletePhysicalAgentResourceImage(Request $request, HomePhysiotherapyProgram $hpfId, PhysicalAgent $physicalAgent, ImageResource $imageResource)
    {
        $imageResource->delete();
        $physicalAgent = $hpfId->physical_agent->load('image_resources')->find($physicalAgent->id);
        return response($physicalAgent, 200);
    }

    public function apiDeletePhysicalAgent(Request $request, HomePhysiotherapyProgram $hpfId, PhysicalAgent $physicalAgent)
    {
        $hpfId->physical_agent()->detach($physicalAgent);
        return $hpfId
            ->with('physical_agent.image_resources')
            ->where('id', $hpfId->id)
            ->first()
            ->physical_agent;
    }

    public function apiCreatePrescription(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        unset($aRequest['image_resources']);
        unset($aRequest['pivot']);
        unset($aRequest['indication']);
        unset($aRequest['precautions']);
        $prescription = new Prescription();
        $prescription->fill($aRequest);
        $prescription->save();
        $base64Files = !empty ($request->imageFiles) ? $request->imageFiles : [];
        $this->_addImages($base64Files, $prescription);
        $hpfId->prescription()->save($prescription);
        $hpfId->prescription()->syncWithoutDetaching(
            [
                $prescription->id => [
                    'indication' => $request->indication,
                    'precautions' => $request->precautions,
                ]
            ]
        );
        $prescription = $hpfId->prescription->load('image_resources')->find($prescription->id);
        return response($prescription, 200);
    }

    public function apiDeletePrescription(Request $request, HomePhysiotherapyProgram $hpfId, Prescription $prescription)
    {
        $hpfId->prescription()->detach($prescription);
        return $hpfId
            ->with('prescription.image_resources')
            ->where('id', $hpfId->id)
            ->first()
            ->prescription;
    }

    public function apiUpdatePrescription(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        unset($aRequest['image_resources']);
        unset($aRequest['pivot']);
        unset($aRequest['indication']);
        unset($aRequest['precautions']);
        $prescription = Prescription::find($request->id);
        $prescription->fill($aRequest);
        $prescription->save();
        $base64Files = !empty ($request->imageFiles) ? $request->imageFiles : [];
        $this->_addImages($base64Files, $prescription);
        $hpfId->prescription()->syncWithoutDetaching(
            [
                $prescription->id => [
                    'indication' => $request->pivot['indication'],
                    'precautions' => $request->pivot['precautions'],
                ]
            ]
        );
        $prescription = $hpfId->prescription->load('image_resources')->find($request->id);
        return response($prescription, 200);
    }

    public function apiDeletePrescriptionResourceImage(Request $request, HomePhysiotherapyProgram $hpfId, Prescription $prescription, ImageResource $imageResource)
    {
        $imageResource->delete();
        $prescription = $hpfId->prescription->load('image_resources')->find($prescription->id);
        return response($prescription, 200);
    }

    public function apiCreateContraindication(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        unset($aRequest['image_resources']);
        $contraindication = new Contraindication();
        $contraindication->fill($aRequest);
        $contraindication->save();
        // $base64Files = !empty($request->imageFiles) ? $request->imageFiles : [];
        // $this->_addImages($base64Files, $contraindication);
        $hpfId->contraindication()->save($contraindication);
        return response($contraindication, 200);
    }

    public function apiDeleteContraindication(Request $request, HomePhysiotherapyProgram $hpfId, Contraindication $contraindication)
    {
        $hpfId->contraindication()->detach($contraindication);
        return $hpfId
            ->where('id', $hpfId->id)
            ->first()
            ->contraindication;
    }

    public function apiUpdateContraindication(Request $request, HomePhysiotherapyProgram $hpfId)
    {
        $aRequest = $request->all();
        $contraindication = Contraindication::find($request->id);
        $contraindication->fill($aRequest);
        $contraindication->save();
        $base64Files = !empty ($aRequest['imageFiles']) ? $aRequest['imageFiles'] : [];
        $this->_addImages($base64Files, $contraindication);
        // $contraindication = $hpfId->contraindication->load('image_resources')->find($request->id);
        return response($contraindication, 200);
    }

    public function edit($id, $stop_index = false)
    {
        $home_physiotherapy_program = HomePhysiotherapyProgram::find($id);
        $jsonValuesArray = json_decode($home_physiotherapy_program->json_values, true) ? json_decode($home_physiotherapy_program->json_values, true) : [];
        return view('valorations.create_home_physiotherapy_program_catalog')->
            with('valorations', $jsonValuesArray)
            ->with('useVue', true)
            ->with('O_model', $home_physiotherapy_program)
            ->with('newVersionRoute', $this->route_path ? $this->route_path . '.new_version' : null);
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), $this->A_validator, $this->A_validator_messages)->validate();
        $home_physiotherapy_program = HomePhysiotherapyProgram::find($id);
        $A_request = $request->toArray();
        unset($A_request['_token']);
        unset($A_request['_method']);
        $home_physiotherapy_program->name = $A_request['name'];
        unset($A_request['name']);
        $this->_extractImages($A_request, 'home_physiotherapy_program_exercises');
        $home_physiotherapy_program->json_values = json_encode($A_request);
        $home_physiotherapy_program->save();
        return redirect(route('home_physiotherapy_program.edit', $home_physiotherapy_program->id));
    }

    public function apiUpdate(Request $request, $id)
    {
        $home_physiotherapy_program = HomePhysiotherapyProgram::find($id);
        $A_request = $request->toArray();
        unset($A_request['_token']);
        unset($A_request['_method']);
        if (!empty ($A_request['home_physiotherapy_program_exercises'])) {
            $this->_extractImages($A_request, 'home_physiotherapy_program_exercises');
        }
        $home_physiotherapy_program->json_values = json_encode($A_request);
        $home_physiotherapy_program->fill($A_request);
        $home_physiotherapy_program->save();
        return response($home_physiotherapy_program, 200);
    }

    private function _extractImages(&$arrayRequest, $index)
    {
        if (!empty ($arrayRequest)) {
            foreach ($arrayRequest[$index] as $key => $element) {
                if (!empty ($element['img'])) {
                    $imgsArray = [];
                    foreach ($element['img'] as $imgKey => $img) {
                        if (is_string($img)) {
                            $imgsArray[] = $img;
                        } else {
                            $S_image_name = time() . uniqid(rand()) . "." . $img->getClientOriginalExtension();
                            $images_path = public_path("images/home_physiotherapy_programs");
                            $img->move($images_path, $S_image_name);
                            $imgsArray[] = $S_image_name;
                        }
                    }
                    $arrayRequest[$index][$key]['img'] = $imgsArray;
                }
            }
        }
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), $this->A_validator, $this->A_validator_messages)->validate();
        $home_physiotherapy_program = new HomePhysiotherapyProgram();
        $A_request = $request->toArray();
        unset($A_request['name']);
        $home_physiotherapy_program->name = $request->name;
        $this->_extractImages($A_request, 'home_physiotherapy_program_exercises');
        $home_physiotherapy_program->json_values = json_encode($A_request);
        $home_physiotherapy_program->user_id = Auth::id();
        $home_physiotherapy_program->save();
        return redirect(route('home_physiotherapy_program.edit', $home_physiotherapy_program->id));
    }
    public function ajax_get_home_physiotherapy_program($string = null)
    {
        $col = HomePhysiotherapyProgram::where("name", "like", "%")->orderBy('name', 'asc')->get();
        if ($string) {
            $col = HomePhysiotherapyProgram::where("name", "like", "%" . $string . "%")->orderBy('name', 'asc')->get();
        }
        return $col->map(function ($home_physiotherapy_program) {
            return [
                'id' => $home_physiotherapy_program->id,
                'label' => $home_physiotherapy_program->name
            ];
        });
    }

    public function ajaxUpdate(Request $request, $id = false)
    {
        $HomePhysiotherapyProgram = HomePhysiotherapyProgram::where('id', $request->id)->first();
        $HomePhysiotherapyProgram->name = $request->name;
        $HomePhysiotherapyProgram->code = $request->code;
        $res = $HomePhysiotherapyProgram->save();
        return json_encode($res);
    }

    public function ajaxDelete(Request $request)
    {
        $HomePhysiotherapyProgram = HomePhysiotherapyProgram::where('id', $request->id)->first();
        $res = $HomePhysiotherapyProgram->delete();
        return json_encode($res);
    }

    private function _addImages(array $base64Files, $exercise)
    {
        foreach ($base64Files as $base64File) {
            if (
                strpos($base64File['path'], 'data:image/png;base64,') !== false ||
                strpos($base64File['path'], 'data:image/jpg;base64,') !== false ||
                strpos($base64File['path'], 'data:image/jpeg;base64,') !== false
            ) {
                $extension = pathinfo($base64File['name'], PATHINFO_EXTENSION);
                $image = $base64File['path'];
                $image = $this->getImageFromBase64($image);
                $imageName = Str::random(50) . '.' . $extension;
                $imageResource = new ImageResource();
                $imageResource->url = $exercise->file_output . $imageName;
                $res = $exercise->image_resources()->save($imageResource);
                $a = Storage::put('public/' . $imageResource->url, $image);
            }
        }
    }

    public function apiGetExerciseCategories(Request $request, $hpfId)
    {
        $exercise = HomePhysiotherapyProgram::find($hpfId);
        $exercise->append('exercise_divisions');
        return $exercise->exercise_divisions;
    }

    public function apiAddExerciseCategory(Request $request, $hpfId)
    {
        $division = ExcerciseDivision::create([
            'name' => $request->input('name')
        ]);
        return ExcerciseDivision::all();
    }
    public function apiAddKeywords(Request $request, $hpfId)
    {
        $exercise = HomePhysiotherapyProgram::find($hpfId);
        $aRequest = $request->all();
        $ids = array_map(function ($keyword) {
            return $keyword['id'];
        }, $request->keywords);
        // $base64Files = !empty($request->imageFiles) ? $request->imageFiles : [];
        // $this->_addImages($base64Files, $contraindication);
        $exercise->keywords()->sync($ids);
        return $exercise;
    }

    public function apiGetKeywords(Request $request, $hpfId)
    {
        $exercise = HomePhysiotherapyProgram::find($hpfId);
        $exercise->append('keywords');
        return $exercise->keywords;
    }

    public function apiAddGlosaryAP(Request $request, $hpfId)
    {
        $exercise = HomePhysiotherapyProgram::find($hpfId);
        $aRequest = $request->all();
        $id = $request->input('glosary_ap', null)['id'];
        // $base64Files = !empty($request->imageFiles) ? $request->imageFiles : [];
        // $this->_addImages($base64Files, $contraindication);
        $exercise->anato_physiology_glosary_item_id = $id;
        $exercise->save();
        return $exercise;
    }

}
