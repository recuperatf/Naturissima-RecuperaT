<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    const STUDIES = [
        [
            'name' => 'biometria_hematica',
            'label' => "Biometría hemática"
        ],
        [
            'name' => 'quimica_sanguinea',
            'label' => "Química Sanguínea"
        ],
        [
            'name' => 'coagulacion',
            'label' => "Prueba de Coagulación (TP/TTP)"
        ],
        [
            'name' => 'pfh',
            'label' => "Pruebas de funcionamiento Hepático"
        ],
        [
            'name' => 'colesterol_total',
            'label' => "Colesterol Total"
        ],
        [
            'name' => 'colesterol_ldl',
            'label' => "Colesterol LDL"
        ],
        [
            'name' => 'ego',
            'label' => "Examen General de Orina"
        ],
        [
            'name' => 'copro',
            'label' => "Coproparasitoscópico"
        ],
        [
            'name' => 'rx',
            'label' => "Radiografía"
        ],
    ];
    protected $guarded = ['id'];
}
