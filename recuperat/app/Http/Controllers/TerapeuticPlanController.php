<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\TerapeuticPlan;
use App\TerapeuticPlanPhase;
use App\TerapeuticPlanPhasesImage;
use Illuminate\Http\Request;
use \App\Http\Controllers\CRUDController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TerapeuticPlanController extends CRUDController
{
    public function create()
    {
        return view('terapeutic_plan.addVue')
            ->with('newVersionRoute', $this->route_path ? $this->route_path . '.new_version' : null)
            ->with('useVue', true);
        // return view('terapeutic_plan.add')->
        // with('title',!empty($this->title)?$this->title:null)->
        // with('form_method','post')->
        // with('form_url',route($this->route_path.'.store'))->
        // with('patient_id',!empty($this->patient_id)? $this->patient_id : null)->
        // with('default', [])->
        // with('keys', $this->keys['create']);
    }
    public function edit($id, $stop_extend = false)
    {
        $model = $this->model_name::where('id', $id)->first();
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship_name) {
                if (!empty($this->keys['edit'])) {
                    if (empty($this->keys['edit'][$relationship_name]['default'])) {
                        $this->keys['edit'][$relationship_name]['default'] = $model->$relationship_name;
                    }
                } else {
                    $collection = $model->$relationship_name;
                    if (!$collection) {
                        unset($this->keys['create'][$relationship_name]['default']);
                        continue;
                    }
                    $this->keys['create'][$relationship_name]['default'] = get_class($collection) == "Illuminate\Database\Eloquent\Collection" ? $model->$relationship_name : collect()->add($model->$relationship_name);
                }
            }
        }
        if (!empty($this->file_relationships)) {
            foreach ($this->file_relationships as $key => $relationship_name) {
                if (!empty($this->keys['edit'])) {
                    $this->keys['edit'][$relationship_name]['default'] = $model->$relationship_name;
                } else {
                    $this->keys['create'][$relationship_name]['default'] = $model->$relationship_name;
                }
            }
        }
        $terapeuticPlan = TerapeuticPlan::with('phases')->
            with('keywords')->
            with('anato_physiology_glosary_item')->
            with('phases.images')->where('id', $id)->first();
        return view('terapeutic_plan.addVue')
            ->with('useVue', true)
            ->with('O_model', $model)
            ->with('newVersionRoute', $this->route_path ? $this->route_path . '.new_version' : null)
            ->with('terapeuticPlanDefault', $terapeuticPlan);
        // return view('terapeutic_plan.add')->
        // with('form_method','put')->
        // with('route_prefix',$this->route_path)->
        // with('form_url',route($this->route_path.'.store'))->
        // with('keys',(!empty($this->keys['edit']))?$this->keys['edit']:$this->keys['create'])->
        // with('stop_extend',$stop_extend)->
        // with('patient_id',!empty($this->patient_id)? $this->patient_id : null)->
        // with('protocol', $this->class_name == '\App\ProtocoloFisioterapiaController' ? $model : null)->
        // with('O_model',$model)->
        // with('printTableHeader', !empty($this->printTableHeader) ? $this->printTableHeader : null);

    }
    public function show($id)
    {
        $model = $this->model_name::where('id', $id)->first();
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship_name) {
                if (!empty($this->keys['edit'])) {
                    if (empty($this->keys['edit'][$relationship_name]['default'])) {
                        $this->keys['edit'][$relationship_name]['default'] = $model->$relationship_name;
                    }
                } else {
                    $collection = $model->$relationship_name;
                    if (!$collection) {
                        unset($this->keys['create'][$relationship_name]['default']);
                        continue;
                    }
                    $this->keys['create'][$relationship_name]['default'] = get_class($collection) == "Illuminate\Database\Eloquent\Collection" ? $model->$relationship_name : collect()->add($model->$relationship_name);
                }
            }
        }
        if (!empty($this->file_relationships)) {
            foreach ($this->file_relationships as $key => $relationship_name) {
                if (!empty($this->keys['edit'])) {
                    $this->keys['edit'][$relationship_name]['default'] = $model->$relationship_name;
                } else {
                    $this->keys['create'][$relationship_name]['default'] = $model->$relationship_name;
                }
            }
        }
        array_unshift($this->keys['create'], $this->keys['create']['keywords']);
        array_unshift($this->keys['create'], $this->keys['create']['anato_physiology_glosary_item']);
        unset($this->keys['create']['keywords']);
        unset($this->keys['create']['anato_physiology_glosary_item']);

        return view('terapeutic_plan.view')->
            with('form_method', 'put')->
            with('route_prefix', $this->route_path)->
            with('form_url', route($this->route_path . '.store'))->
            with('keys', $this->keys['create'])->
            with('stop_extend', false)->
            with('patient_id', !empty($this->patient_id) ? $this->patient_id : null)->
            with('protocol', $this->class_name == '\App\ProtocoloFisioterapiaController' ? $model : null)->
            with('O_model', $model)->
            with('printTableHeader', !empty($this->printTableHeader) ? $this->printTableHeader : null)->
            with('newVersionRoute', $this->route_path ? $this->route_path . '.new_version' : null);

    }

    public function apiStorePhase(Request $request)
    {
        $allRquest = $request->all();
        $res = TerapeuticPlanPhase::create($allRquest);
        return $res;
    }

    public function apiUpdate(Request $request, $id)
    {
        $tp = TerapeuticPlan::find($id);
        $allRquest = $request->all();
        if (!empty($allRquest['keywords'])) {
            #get id key form all of these
            $ids = array_map(function ($item) {
                return $item['id'];
            }, $allRquest['keywords']);
            $tp->keywords()->sync($ids);
        } else {
            $tp->keywords()->sync([]);
        }
        if (!empty($allRquest['anato_physiology_glosary_item']))
            $allRquest['anato_physiology_glosary_item_id'] = $allRquest['anato_physiology_glosary_item']['id'];
        $tp->update($allRquest);
        return TerapeuticPlan::with('phases')->
            with('keywords')->
            with('anato_physiology_glosary_item')->
            with('phases.images')->find($id);
    }

    public function apiUpdatePhase(Request $request, $id)
    {
        $allRquest = $request->all();
        $terapeuticPlanPhase = TerapeuticPlanPhase::find($id);
        unset($allRquest['images']);
        $terapeuticPlanPhase->update($allRquest);
        return TerapeuticPlanPhase::find($id);
    }

    public function deletePhase(Request $request, $id)
    {
        $terapeuticPlanPhase = TerapeuticPlanPhase::find($id);
        $images = TerapeuticPlanPhasesImage::where('terapeutic_plan_phase_id', $id)->get();
        foreach ($images as $key => $image) {
            $image->delete();
        }
        $terapeuticPlanPhase->delete();
        return $id;
    }

    public function apiDeletePhaseImage(Request $request, $id)
    {
        $terapeuticPlanPhaseImage = TerapeuticPlanPhasesImage::find($id);
        $terapeuticPlanPhaseImage->delete();
        return $terapeuticPlanPhaseImage;
    }

    public function apiStorePhaseImage(Request $request, $id)
    {
        $file = $request->file('file');
        $unixTimeStamp = Carbon::now()->timestamp;
        $filename = $unixTimeStamp . $file->getClientOriginalName();
        $file->move(public_path('images/terapeutic_plan_phases_images'), $filename);
        $image = TerapeuticPlanPhasesImage::create([
            'terapeutic_plan_phase_id' => $id,
            'url' => 'images/terapeutic_plan_phases_images/' . $filename,
        ]);

        return $image;
    }

    public function newVersion($id)
    {
        $terapeuticPlan = TerapeuticPlan::find($id);
        $newTerapeuticPlan = $terapeuticPlan->replicate();
        $newTerapeuticPlan->is_sealed = false;
        $newTerapeuticPlan->name = $newTerapeuticPlan->name . "($newTerapeuticPlan->id)";
        $newTerapeuticPlan->save();
        return redirect(route('terapeutic_plan.edit', $newTerapeuticPlan->id));
    }

    public function update(Request $request, $id)
    {
        $model = $this->model_name::where('id', $id)->first();
        if ($extras = $request->input('extras', null)) {
            $model->extras = json_encode($extras);
        } else {
            $model->extras = json_encode([]);
        }
        if (!empty($this->A_validator_update)) {
            $this->A_validator_update = array_map(
                function ($string) use ($model) {
                    $string = str_replace('{{id}}', $model->id, $string);
                    return $string;
                },
                $this->A_validator_update
            );
            Validator::make($request->all(), $this->A_validator_update, $this->A_validator_messages)->validate();
        } elseif (!empty($this->A_validator)) {
            Validator::make($request->all(), $this->A_validator, $this->A_validator_messages)->validate();
        }
        $A_request = $request->all();
        unset($A_request['_token']);
        unset($A_request['refresh']);
        $A_relationships = [];
        if (!empty($this->files)) {
            foreach ($this->files as $fileField) {
                if ($request->$fileField) {
                    $originalFileName = $request->file($fileField)->getClientOriginalName();
                    $tmpFile = $request->file($fileField)->getPathName();
                    $A_request[$fileField] = $originalFileName;
                    Storage::cloud()->put($originalFileName, $request->$fileField->get());
                }
            }
        }
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship_name) {
                if (!empty($A_request[$relationship_name])) {
                    $A_relationships[$relationship_name]['value'] = $A_request[$relationship_name];
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['type'] = 'normal';
                } else {
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['value'] = [];
                    $A_relationships[$relationship_name]['type'] = 'normal';
                }
                unset($A_request[$relationship_name]);
            }
        }
        if (!empty($this->file_relationships)) {
            foreach ($this->file_relationships as $key => $relationship_name) {
                if (!empty($A_request[$relationship_name])) {
                    $A_relationships[$relationship_name]['file'] = $A_request[$relationship_name];
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['type'] = 'file';

                } else {
                    $A_relationships[$relationship_name]['type'] = 'file';
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['file'] = [];
                }
                unset($A_request[$relationship_name]);
            }
        }
        if (($id = Auth::id()) && !empty($this->keys['user_id'])) {
            $model->user_id = $id;
        }
        $model->update($A_request);
        foreach ($A_relationships as $relationship_name => $relationship) {
            $class = explode('\\', get_class($model->$relationship_name()));
            $rel_model = $class[sizeof($class) - 1];
            if ($relationship['type'] == 'file') {
                ;
                //delete non required images
                $filesToDelete = $model->$relationship_name;
                foreach ($relationship['file'] as $file) {
                    if (is_string($file)) {
                        $filesToDelete = $filesToDelete->where('url', '!=', $file);
                        continue;
                    }
                    $S_file_name = time() . uniqid(rand()) . "." . $file->getClientOriginalExtension();
                    $relationship['value']['url'] = $this->file_output . $S_file_name;
                    $res = $file->move(public_path($this->file_output), $S_file_name);
                    $A_model_info['url'] = $this->file_output . $S_file_name;
                    $model_route = $relationship['model'];
                    $model_class = new $model_route($A_model_info);
                    $model->$relationship_name()->save($model_class);
                }
                foreach ($filesToDelete as $file) {
                    $file->delete();
                }
            } else {
                if ($rel_model == "HasMany") {
                    $model->$relationship_name()->delete();
                    $model_route = $relationship['model'];
                    foreach ($relationship['value'] as $inmodel_info) {
                        $model_class = new $model_route($inmodel_info);
                        $model->$relationship_name()->save($model_class);
                    }
                } elseif ('BelongsTo' == $rel_model) {
                    $keyName = $model->$relationship_name()->getForeignKeyName();
                    if (empty($relationship['value'][0])) {
                        $model->$keyName = null;
                    } else {
                        $model->$keyName = $relationship['value'][0];
                    }
                    $model->save();
                } else {
                    $model->$relationship_name()->sync($relationship['value']);
                }
            }

        }
        if ($request->input('refresh')) {
            return redirect()->route($this->route_path . '.edit_stop_extend', ['id' => $model->id, 'stop_extend' => true]);
            return view('CRUDViews.add')->
                with('form_method', 'put')->
                with('route_prefix', $this->route_path)->
                with('form_url', route($this->route_path . '.store'))->
                with('keys', $this->keys['create'])->
                with('O_model', $model)->
                with('stop_extend', true);
        }
        return redirect(route($this->route_path . '.index'))->with('success', 'Se ha modificado con exito');
    }

    public function __construct(array $attributes = array())
    {
        parent::__construct();
        $this->index_search_fields = array(
            'name',
            'keywords'
        );
        $this->route_path = 'terapeutic_plan';
        $this->printTableHeader = true;
        $this->permissions = [
            'create' => 'terapeutic_plans.create',
            'edit' => 'terapeutic_plans.see',
            'delete' => 'terapeutic_plans.delete'
        ];
        $this->class_name = '\App\TerapeuticPlanController';
        $this->model_name = '\App\TerapeuticPlan';
        $this->short_model_name = 'TerapeuticPlan';
        $this->file_output = 'images/plans_images/diagnosis/';
        $this->A_validator = [
            'name' => 'required',
            // 'description' => 'required'
        ];
        $this->A_validator_messages = [
            'name.required' => 'El campo de nombre es obligatorio',
        ];
        $this->relationships = [
            'OutsideResource' => 'outside_resources',
            'keywords',
            'anato_physiology_glosary_item',
        ];
        $this->file_relationships = [
            'ImageResource' => 'image_resources'
        ];
        $this->keys = [
            'index' => [
                'name' => 'Nombre',
                'description' => 'Descripción',
                'is_sealed_text' => 'Sellado',
            ],
            'create' => [
                ['label' => 'Nombre', 'type' => 'separator', 'class' => "no_print", 'tag' => 'h4', 'no_count' => true],
                ['key' => 'name', 'label' => '', 'class' => "no_print", 'type' => 'text'],
                ['label' => 'Descripción', 'type' => 'separator', 'tag' => 'h4', 'no_count' => true],
                ['key' => 'description', 'label' => '', 'type' => 'text'],
                'anato_physiology_glosary_item' => [
                    'single' => true,
                    'addRoute' => 'anato_physiology_glosary_item.create',
                    'key' => 'anato_physiology_glosary_item',
                    "print" => true,
                    'label' => 'Categoría anatómica/fisiológica',
                    'type' => 'autocompletable_multiple',
                    'class' => 'anato_physiology_glosary_item',
                    'name' => 'anato_physiology_glosary_item',
                    'url' => 'anato_physiology_glosary_item/ajaxGet'
                ],
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
                ['label' => 'Evaluación Inicial', 'type' => 'separator', 'tag' => 'h4', 'no_count' => true],
                ['key' => 'initial_evaluation', 'label' => '', 'class' => "no_print", 'type' => 'text'],
                ['label' => 'Clave', 'type' => 'separator', 'class' => "no_print", 'tag' => 'h4', 'no_count' => true],
                ['key' => 'code', 'label' => '', 'class' => "no_print", 'type' => 'text'],
                ['label' => 'Páginas', 'type' => 'separator', 'class' => "no_print", 'tag' => 'h4', 'no_count' => true],
                ['key' => 'pages', 'label' => '', 'class' => "no_print", 'type' => 'text'],
                ['label' => 'Version', 'type' => 'separator', 'class' => "no_print", 'tag' => 'h4', 'no_count' => true],
                ['key' => 'version', 'label' => '', 'class' => "no_print", 'type' => 'text'],
                ['label' => 'Revisado por', 'type' => 'separator', 'class' => "no_print", 'tag' => 'h4', 'no_count' => true],
                ['key' => 'revised_by', 'label' => '', 'class' => "no_print", 'type' => 'text'],
                ['label' => 'Elaborado por', 'type' => 'separator', 'class' => "no_print", 'tag' => 'h4', 'no_count' => true],
                ['key' => 'made_by', 'label' => '', 'class' => "no_print", 'type' => 'text'],
                ['key' => 'fases', 'type' => 'fases'],
                ['label' => 'Bibliografía', 'no_count' => true, 'link' => ['text' => 'APA ITEMS', 'class' => "no_print", 'href' => 'https://www.cva.itesm.mx/biblioteca/pagina_con_formato_version_oct/apaweb.html'], 'type' => 'separator', 'tag' => 'h4'],
                ['key' => 'bibliography', 'label' => '', 'type' => 'textarea', 'rows' => '4'],
                ['key' => 'is_sealed', 'label' => 'Sellar versión', 'type' => 'checkbox', "print" => false],
                //Dublin core
                ['onlyAdmin' => true, 'label' => 'Dublin core', 'no_count' => true, 'class' => 'no_print', 'type' => 'separator', 'tag' => 'h4', "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'abstract', 'label' => 'DC.Resumen', 'type' => 'textarea', 'rows' => 5, "print" => false],
                // ['class'=>'no_print', 'onlyAdmin' => true, 'key'=>'description', 'label'=>'DC.Descripción', 'type'=>'textarea', 'rows'=> 5, "print"=>false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'subject', 'label' => 'DC.Tema', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'source', 'label' => 'DC.Fuente', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'language', 'label' => 'DC.Idioma', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'relation', 'label' => 'DC.Relación', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'coverage', 'label' => 'DC.Cobertura', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'publisher', 'label' => 'DC.Editor', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'contributor', 'label' => 'DC.Colaboradores', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'rights', 'label' => 'DC.Derechos', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'date', 'label' => 'DC.Fecha', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'type', 'label' => 'DC.Tipo', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'format', 'label' => 'DC.Formato', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'identifier', 'label' => 'DC.Identificador', 'type' => 'textarea', 'rows' => 1, "print" => false],

                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'creator', 'label' => 'DC.Creador', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'date_issued', 'label' => 'DC.Fecha de emisión', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'latest_version', 'label' => 'DC.Última versión', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'version_history', 'label' => 'DC.Historial de versiones', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'document_status', 'label' => 'DC.Estatus del documento', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'doi', 'label' => 'DC.DOI', 'type' => 'textarea', 'rows' => 1, "print" => false],

            ]
        ];
    }
}
