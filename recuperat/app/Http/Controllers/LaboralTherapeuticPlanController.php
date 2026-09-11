<?php

namespace App\Http\Controllers;

use App\LoboralTherapeuticPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\CRUDController;

class LaboralTherapeuticPlanController extends CRUDController
{
    public function __construct(array $attributes = array()){
        parent::__construct();

        $this->route_show = 'laboral_terapeutic_plan.show';
        $this->permissions = [
            'edit' => 'laboral_terapeutic_plan.edit',
            'delete' => 'laboral_terapeutic_plan.delete'
        ];
        $this->index_search_fields = array(
            'name'
        );
        $this->route_path = 'laboral_terapeutic_plan';
        $this->route_update = 'laboral_terapeutic_plan';
        $this->class_name = '\App\LaboralTherapeuticPlanController';
        $this->model_name = '\App\LaboralTherapeuticPlan';
        $this->short_model_name = 'LaboralTherapeuticPlan';
        $this->A_validator = [
            'name' => 'required',
        ];
        $this->A_validator_messages = [
            'name.required'=>'El campo de nombre es obligatorio',
        ];
        $this->file_output = 'images/laboral_therapeutic_plan/';
        $this->file_relationships = [
            'ImageResource'=>'image_resources'
        ];
        $this->keys = [
            'index' => [
                'name'=>'Nombre',
            ],
            'create' => [
                ['key'=>'name', 'label'=>'Nombre', 'type'=>'text'],
                'image_resources'=>['key'=>'image_resources', 'label'=>'Imágenes', 'type' => 'multiple_images'],
            ]
        ];
    }


}
