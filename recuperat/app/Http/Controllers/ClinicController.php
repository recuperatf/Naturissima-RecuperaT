<?php

namespace App\Http\Controllers;

use App\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\CRUDController;

class ClinicController extends CRUDController
{
    public function __construct(array $attributes = array()){
        parent::__construct();

        $this->index_search_fields = array(
            'name'
        );
        $this->route_path = 'clinics';
        $this->class_name = '\App\ClinicController';
        $this->model_name = '\App\Clinic';
        $this->short_model_name = 'Clinic';
        $this->file_output = 'images/clinic_controller/';
        $this->A_validator = [
            'name' => 'required',
        ];
        $this->A_validator_messages = [
            'name.required'=>'El campo de nombre es obligatorio',
        ];
        $this->file_relationships = [
            'ImageResource'=>'image_resources'
        ];
        $this->keys = [
            'index' => [
                'name'=>'Nombre',
            ],
            'create' => [
                ['key'=>'name', 'label'=>'Nombre', 'type'=>'text'],
                ['key'=>'street', 'label'=>'Calle', 'type'=>'text'],
                ['key'=>'number', 'label'=>'Numero', 'type'=>'text'],
                ['key'=>'frac', 'label'=>'Fraccionamiento', 'type'=>'text'],
                'image_resources'=>['key'=>'image_resources', 'label'=>'Fotografías', 'type' => 'multiple_images'],
            ]
        ];
    }
}
