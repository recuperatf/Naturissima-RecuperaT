<?php

namespace App\Http\Controllers;

use App\CatCIE10;
use Illuminate\Http\Request;
use \App\Http\Controllers\CRUDController;
use Illuminate\View\View;

class CatCIE10Controller extends CRUDController
{
    /**
     * Display a listing of CIE (Catalogo Internacional de enfermedades).
     *
     * @return \Illuminate\Http\Response
     */

    public $keys = [
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct();

        $this->index_search_fields = array(
            'code',
            'name'
        );
        $this->route_path = 'cie10';
        $this->class_name = '\App\CatCIE10Controller';
        $this->model_name = '\App\CatCIE10';
        $this->short_model_name = 'CatCIE10';
        $this->file_output = 'images/plans_images/diagnosis/';
        $this->A_validator_update = [
            'none'
        ];
        $this->A_validator = [
            'name' => 'required',
            'code' => 'required'
        ];
        $this->A_validator_messages = [
            'name.required' => 'El campo de nombre es obligatorio',
            'code.required' => 'El campo de clave es obligatorio',
        ];
        $this->relationships = [
            'sintomas',
            'clinic_diagnosis',
            'radiologic_diagnosis',
            'treatments',
            'home_plans',
        ];
        $this->file_relationships = [

        ];
        $this->keys = [
            'index' => [
                'code' => 'Clave',
                'name' => 'Nombre',
                'user_id.filter' => 'Usuario',
            ],
            'user_id' => true,
            'create' => [
                ['key' => 'name', 'label' => 'Nombre', 'type' => 'text', 'class' => 'no_print_iframe'],
                ['key' => 'code', 'label' => 'Clave', 'type' => 'text', 'class' => 'no_print_iframe'],
                ['key' => 'definition', 'label' => 'Definición', 'type' => 'text'],
                ['key' => 'epidemiology', 'label' => 'Epidemiología', 'type' => 'text'],
                ['key' => 'etiology', 'label' => 'Etiología', 'type' => 'textarea', 'rows' => 4],
                ['key' => 'text_symptoms', 'label' => 'Sintomas', 'type' => 'textarea', 'rows' => 3],
                ['key' => 'text_radiologic_diagnosis', 'label' => 'Estudios radiológicos y de laboratorio', 'type' => 'textarea', 'rows' => 3],
                ['key' => 'text_clinic_radiologic_diagnosis', 'label' => 'Diagnóstico fisioterapéutico', 'type' => 'textarea', 'rows' => 3],
                'treatments' => [
                    'key' => 'treatments',
                    'label' => 'Planes Terapéuticos (catálogo)',
                    'type' => 'autocompletable_multiple',
                    'viewRoute' => 'terapeutic_plan.show',
                    'class' => 'treatments',
                    'name' => 'treatments',
                    'url' => 'terapeutic_plan/ajaxGet'
                ],
                'home_plans' => [
                    'key' => 'home_plans',
                    'label' => 'Programa terapéutico en casa (Catálogo de programas fisioterapéuticos en casa)',
                    'type' => 'autocompletable_multiple',
                    'viewRoute' => 'home_physiotherapy_program.show',
                    'class' => 'home_plans',
                    'name' => 'home_plans',
                    'url' => 'get_home_physiotherapy_program'
                ],
            ],
            'edit' => [

                [
                    'key' => 'name',
                    'label' => 'Nombre',
                    'type' => 'text',
                    'class' => 'no_print_iframe',
                    'attributes' => [
                        'disabled' => true
                    ]
                ],
                [
                    'key' => 'code',
                    'label' => 'Clave',
                    'type' => 'text',
                    'class' => 'no_print_iframe',
                    'attributes' => [
                        'disabled' => true
                    ]
                ],

                ['key' => 'definition', 'label' => 'Definición', 'type' => 'text'],
                ['key' => 'epidemiology', 'label' => 'Epidemiología', 'type' => 'text'],
                ['key' => 'etiology', 'label' => 'Etiología', 'type' => 'textarea', 'rows' => 4],
                ['key' => 'text_symptoms', 'label' => 'Sintomas', 'type' => 'textarea', 'rows' => 3],
                ['key' => 'text_radiologic_diagnosis', 'label' => 'Estudios radiológicos y de laboratorio', 'type' => 'textarea', 'rows' => 3],
                ['key' => 'text_clinic_radiologic_diagnosis', 'label' => 'Diagnóstico fisioterapéutico', 'type' => 'textarea', 'rows' => 3],
                'treatments' => [
                    'key' => 'treatments',
                    'label' => 'Planes Terapéuticos (catálogo)',
                    'type' => 'autocompletable_multiple',
                    'viewRoute' => 'terapeutic_plan.show',
                    'class' => 'treatments',
                    'name' => 'treatments',
                    'url' => 'terapeutic_plan/ajaxGet'
                ],
                'home_plans' => [
                    'key' => 'home_plans',
                    'label' => 'Programa terapéutico en casa (Catálogo de programas fisioterapéuticos en casa)',
                    'type' => 'autocompletable_multiple',
                    'viewRoute' => 'home_physiotherapy_program.show',
                    'class' => 'home_plans',
                    'name' => 'home_plans',
                    'url' => 'get_home_physiotherapy_program'
                ],
            ]
        ];
    }

    /**
     * Get the specified CIE10 from storage, utility for autocompletable fields.
     * @param mixed $string
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function ajax_get_cie10($string = null)
    {
        $col = CatCIE10::where("name", "like", "%")->limit(20)->orderBy('name', 'asc')->get();
        if ($string) {
            $col = CatCIE10::where("name", "like", "%" . $string . "%")->orWhere('code', 'like', '%' . $string . '%')->limit(20)->orderBy('name', 'asc')->get();
        }
        return $col->map(function ($cie10) {
            return [
                'id' => $cie10->id,
                'label' => $cie10->code_plus_name
            ];
        });
        return $col->pluck('name', 'id')->toArray();
    }

    /**
     * Update the specified CIE10 in storage. Utility for Javascript.
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return string
     */

    public function ajaxUpdate(Request $request, $id = false)
    {
        $CatCIE10 = CatCIE10::where('id', $request->id)->first();
        $CatCIE10->name = $request->name;
        $CatCIE10->code = $request->code;
        $res = $CatCIE10->save();
        return json_encode($res);
    }

    /**
     * Get the specified CIE10 from storage, deleeting with JS.
     * @param mixed $string
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function ajaxDelete(Request $request)
    {
        $CatCIE10 = CatCIE10::where('id', $request->id)->first();
        $res = $CatCIE10->delete();
        return json_encode($res);
    }

    /**
     * Store a newly created CIE10 in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function cie10_form(Request $request, $id): View
    {
        $model = $this->model_name::where('id', $id)->first();
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship_name) {
                $this->keys['create'][$relationship_name]['default'] = $model->$relationship_name;
            }
        }
        if (!empty($this->file_relationships)) {
            foreach ($this->file_relationships as $key => $relationship_name) {
                $this->keys['create'][$relationship_name]['default'] = $model->$relationship_name;
            }
        }
        return view('CRUDViews.add')->
            with('form_method', 'put')->
            with('route_prefix', $this->route_path)->
            with('form_url', route($this->route_path . '.store'))->
            with('keys', $this->keys['create'])->
            with('stop_extend', true)->
            with('O_model', $model);
    }
    /**
     * Return view to create a new CIE10.
     * @return View
     */
    public function create()
    {
        return view('catcie10.add')->
            with('title', !empty($this->title) ? $this->title : null)->
            with('form_method', 'post')->
            with('form_url', route($this->route_path . '.store'))->
            with('patient_id', !empty($this->patient_id) ? $this->patient_id : null)->
            with('default', [])->
            with('keys', $this->keys['create']);
    }
    /**
     * Return view to edit a CIE10.
     * @param mixed $id
     * @param mixed $stop_extend
     * @return \Illuminate\View\View
     */
    public function edit($id, $stop_extend = false): View
    {
        $model = $this->model_name::where('id', $id)->first();
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship_name) {
                if (!empty($this->keys['edit'])) {
                    if (empty($this->keys['edit'][$relationship_name]['default'])) {
                        $this->keys['edit'][$relationship_name]['default'] = $model->$relationship_name;
                    }
                } else {
                    $this->keys['create'][$relationship_name]['default'] = $model->$relationship_name;
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
        return view('catcie10.add')->
            with('form_method', 'put')->
            with('route_prefix', $this->route_path)->
            with('form_url', route($this->route_path . '.store'))->
            with('keys', (!empty($this->keys['edit'])) ? $this->keys['edit'] : $this->keys['create'])->
            with('stop_extend', $stop_extend)->
            with('patient_id', !empty($this->patient_id) ? $this->patient_id : null)->
            with('protocol', $this->class_name == '\App\ProtocoloFisioterapiaController' ? $model : null)->
            with('O_model', $model);
    }
}
