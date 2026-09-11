<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatCIE10 extends Model
{
    protected $table = "cat_cie10s";
    protected $guarded = ['id'];
    public $fields = [
        ['key' => 'name', 'label' => 'Título', 'type' => 'text'],
        ['key' => 'definition', 'label' => 'Definición', 'type' => 'text'],
        ['key' => 'epidemiology', 'label' => 'Epidemiología', 'type' => 'text'],
        ['key' => 'text_lesion_mecanism', 'label' => 'Mecanismo de lesión', 'type' => 'text'],
        ['key' => 'text_symptoms', 'label' => 'Sintomas Texto', 'type' => 'text'],
        ['key' => 'text_diagnosis', 'label' => 'Diagnósticos Texto', 'type' => 'text'],
        ['key' => 'text_physical_treatments', 'label' => 'Agentes físicos Texto', 'type' => 'text'],
        ['key' => 'text_excersice_treatments', 'label' => 'Modalidades de ejercicio', 'type' => 'text'],
        ['key' => 'text_functional_activites', 'label' => 'Actividades Funcionales', 'type' => 'text'],
        ['key' => 'text_home_plan', 'label' => 'Tareas en casa', 'type' => 'text'],

        [
            'key' => 'sintomas',
            'label' => 'Síntomas CIE10',
            'type' => 'autocompletable_multiple',
            'class' => 'tests_and_meassurements',
            'name' => 'tests_and_meassurements',
            'url' => '/ajax_get_cie10/'
        ],
        [
            'key' => 'clinic_diagnosis',
            'label' => 'Diagnóstico Clinico CIE10',
            'type' => 'autocompletable_multiple',
            'class' => 'tests_and_meassurements',
            'name' => 'tests_and_meassurements',
            'url' => 'diagnosis_plan/ajaxGet'
        ],
        [
            'key' => 'radiologic_diagnosis',
            'label' => 'Diagnóstico Radiológico CIE9',
            'type' => 'autocompletable_multiple',
            'class' => 'tests_and_meassurements',
            'name' => 'tests_and_meassurements',
            'url' => 'diagnosis_plan/ajaxGet'
        ],
        [
            'key' => 'treatments',
            'label' => 'Tratamientos CIE10',
            'type' => 'autocompletable_multiple',
            'class' => 'tests_and_meassurements',
            'name' => 'tests_and_meassurements',
            'url' => 'diagnosis_plan/ajaxGet'
        ],
        [
            'key' => 'home_plans',
            'label' => 'Programa terapéutico en casa (Catálogo de programas fisioterapéuticos en casa)',
            'type' => 'autocompletable_multiple',
            'class' => 'home_plans',
            'name' => 'home_plans',
            'url' => 'get_home_physiotherapy_program'
        ],
    ];

    public function getCodePlusNameAttribute($value)
    {
        return "(" . $this->code . ") " . $this->name;
    }

    public function sintomas()
    {
        return $this->belongsToMany('App\CatCIE10', 'cat_cie10_symptoms', 'child_id', 'parent_id');
    }
    public function clinic_diagnosis()
    {
        return $this->belongsToMany('App\DiagnosisPlan', 'cat_cie10_clinical_diagnosis', 'cat_cie10_id', 'diagnosis_plan_id');
    }

    public function radiologic_diagnosis()
    {
        return $this->belongsToMany('App\Cie9Mc', 'cat_cie10_radiologic_diagnosis', 'cat_cie10_id', 'cie9mc_id');
    }

    public function treatments()
    {
        return $this->belongsToMany('App\TerapeuticPlan', 'cat_cie10_treatments', 'cat_cie10_id', 'terapeutic_plan_id');
    }
    public function home_plans()
    {
        return $this->belongsToMany('App\HomePhysiotherapyProgram', 'cat_cie10_home_plans', 'cat_cie10_id', 'home_plan_id');
    }
}
