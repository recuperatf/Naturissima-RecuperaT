<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcerciseDivisionsController extends CRUDController
{
    public function __construct(array $attributes = array()){
        parent::__construct();

        $this->route_path = 'excercise_divisions';
        $this->printTableHeader = true;
        // $this->permissions = [
        //     'edit' => 'terapeutic_plans.see',
        //     'delete' => 'terapeutic_plans.delete'
        // ];
        $this->class_name = '\App\ExcerciseDivisionsController';
        $this->model_name = '\App\ExcerciseDivision';
        $this->short_model_name = 'ExcerciseDivision';
        // $this->file_output = 'images/plans_images/diagnosis/';
        $this->A_validator = [
            'name' => 'required',
            // 'description' => 'required'
        ];
        $this->A_validator_messages = [
            'name.required'=>'El campo de nombre es obligatorio',
        ];
        $this->relationships = [];
        $this->file_relationships = [];
        $this->keys = [
            'index' => [
                'name'=>'Nombre',
            ],
            'create' => [
                'name'=>['key' => 'name' , 'label' => 'Nombre', 'type' => 'text', "class"=>'no_print'],
            ],
        ];
    }

}
