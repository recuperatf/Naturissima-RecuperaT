<?php

namespace App\Http\Controllers;

use App\ProtocoloFisioterapiaLMG;
use Illuminate\Http\Request;

class ProtocoloFisioterapiaLMGController extends CRUDController
{
    public function __construct(array $attributes = array()){
        parent::__construct();
        $this->index_search_fields = array(
            'name'
        );
        $this->route_path = 'protocolos_fisioterapia_lmg';
        $this->class_name = '\App\ProtocoloFisioterapiaLMGController';
        $this->model_name = '\App\ProtocoloFisioterapiaLMG';
        $this->short_model_name = 'ProtocoloFisioterapiaLMG';
        $this->printTableHeader = true;
        // $this->file_output = 'images/protocolos_fisioterapia/';
        $this->A_validator = [
            'name' => 'required',
        ];
        $this->A_validator_messages = [
            'name.required'=>'El campo de nombre es obligatorio',
        ];
        $this->defaultFalses = ['mild', 'moderate', 'severe'];
        // $this->relationships = [
        //     'cie10_risk_factors',
        //     'cie10_lesions_pf',
        //     'tests_and_meassurements',
        // ];
        $this->file_relationships = [
        ];
        $this->keys = [
            'index' => [
                'name'=>'Nombre',
            ],
            'user_id' => true,
            'create' => [
                ['key'=>'name', 'label'=>'Nombre', 'type'=>'text'],
                ['key'=>'mild', 'label'=>'Leve', 'type'=>'checkbox'],
                ['key'=>'moderate', 'label'=>'Moderado', 'type'=>'checkbox'],
                ['key'=>'severe', 'label'=>'Grave', 'type'=>'checkbox'],

                ['label'=>'Leve:', 'type'=>'separator', 'tag'=>'h4', 'no_count' => true],
                ['key'=>'mild_phisiotherapy_sesions', 'label'=>'Sesión', 'type'=>'textarea', 'rows'=>4],

                ['key'=>'mild_phisiotherapy_time', 'label'=>'Tiempo', 'type'=>'text'],

                ['key'=>'mild_phisiotherapy_number_of_sesions', 'label'=>'Número de sesiones', 'type'=>'text'],

                ['label'=>'Moderado:', 'type'=>'separator', 'tag'=>'h4', 'no_count' => true],
                ['key'=>'moderate_phisiotherapy_sesions', 'label'=>'Sesión', 'type'=>'textarea', 'rows'=>4],

                ['key'=>'moderate_phisiotherapy_time', 'label'=>'Tiempo', 'type'=>'text'],

                ['key'=>'moderate_phisiotherapy_number_of_sesions', 'label'=>'Número de sesiones', 'type'=>'text'],

                ['label'=>'Grave:', 'type'=>'separator', 'tag'=>'h4', 'no_count' => true],
                ['key'=>'severe_phisiotherapy_sesions', 'label'=>'Sesión', 'type'=>'textarea', 'rows'=>4],

                ['key'=>'severe_phisiotherapy_time', 'label'=>'Tiempo', 'type'=>'text'],

                ['key'=>'severe_phisiotherapy_number_of_sesions', 'label'=>'Número de sesiones', 'type'=>'text'],

            ]
        ];
    }
}
