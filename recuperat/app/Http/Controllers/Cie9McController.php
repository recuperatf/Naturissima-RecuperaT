<?php

namespace App\Http\Controllers;

use App\Cie9Mc;
use Illuminate\Http\Request;
use \App\Http\Controllers\CRUDController;

class Cie9McController extends CRUDController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $keys = [
    ];

    /**
     * Create a new controller instance.
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct();

        $this->index_search_fields = array(
            'key',
            'name'
        );
        $this->route_path = 'cie9_mc';
        $this->class_name = '\App\Cie9McController';
        $this->model_name = '\App\Cie9Mc';
        $this->short_model_name = 'Cie9Mc';
        // $this->file_output = 'images/plans_images/diagnosis/';
        $this->A_validator = [
            'name' => 'required',
            'key' => 'required'
        ];
        $this->A_validator_update = [
            'none'
        ];
        $this->A_validator_messages = [
            'name.required' => 'El campo de nombre es obligatorio',
            'key.required' => 'El campo de clave es obligatorio',
        ];
        $this->relationships = [
        ];
        $this->file_relationships = [

        ];
        $this->keys = [
            'index' => [
                'key' => 'Clave',
                'name' => 'Nombre',
                'type' => 'Tipo',
                'sex' => 'Sexo',
                'user_id.filter' => 'Usuario',
            ],
            'user_id' => true,
            'create' => [
                ['key' => 'name', 'label' => 'Nombre', 'type' => 'text'],
                ['key' => 'key', 'label' => 'Clave', 'type' => 'text', 'disabled' => true],
                'type' => [
                    'key' => 'type',
                    'label' => 'Tipo',
                    'type' => 'select',
                    'options' => [
                        ['DIAGNOSTICO' => 'DIAGNOSTICO',],
                        ['TERAPEUTICO' => 'TERAPEUTICO',],
                        ['AMBOS' => 'AMBOS',],
                    ],
                    'name' => 'type'
                ],
                'sex' => [
                    'key' => 'sex',
                    'label' => 'Sexo',
                    'type' => 'select',
                    'options' => [
                        ['0' => 'Femenino'],
                        ['1' => 'Masculino'],
                    ],
                    'name' => 'sex'
                ],
            ],
            'edit' => [
                ['key' => 'name', 'label' => 'Nombre', 'type' => 'text', 'attributes' => ['disabled' => true]],
                ['key' => 'key', 'label' => 'Clave', 'type' => 'text', 'disabled' => true, 'attributes' => ['disabled' => true]],
                'type' => [
                    'key' => 'type',
                    'label' => 'Tipo',
                    'type' => 'select',
                    'options' => [
                        ['DIAGNOSTICO' => 'DIAGNOSTICO',],
                        ['TERAPEUTICO' => 'TERAPEUTICO',],
                        ['AMBOS' => 'AMBOS',],
                    ],
                    'name' => 'type'
                ],
                'sex' => [
                    'key' => 'sex',
                    'label' => 'Sexo',
                    'type' => 'select',
                    'options' => [
                        ['0' => 'Femenino'],
                        ['1' => 'Masculino'],
                    ],
                    'name' => 'sex'
                ],
            ]
        ];
    }

    /**
     * JS Utility for updating Cie9MC
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return bool|string
     */
    public function ajaxUpdate(Request $request, $id = false)
    {
        $Cie9Mc = Cie9Mc::where('id', $request->id)->first();
        $Cie9Mc->name = $request->name;
        $Cie9Mc->key = $request->key;
        $Cie9Mc->type = $request->type;
        $Cie9Mc->sex = $request->sex;
        $res = $Cie9Mc->save();
        return json_encode($res);
    }

    /**
     * JS Utility for deleting Cie9MC
     * @param \Illuminate\Http\Request $request
     * @return bool|string
     */
    public function ajaxDelete(Request $request)
    {
        $Cie9Mc = Cie9Mc::where('id', $request->id)->first();
        $res = $Cie9Mc->delete();
        return json_encode($res);
    }

    /**
     * JS Utility for creating Cie9MC
     * @param \Illuminate\Http\Request $request
     * @return bool|string
     */

    public function ajax_get_cie9_mc($string = null)
    {
        $col = Cie9Mc::where("name", "like", "%")->limit(20)->orderBy('name', 'asc')->get();
        if ($string) {
            $col = Cie9Mc::where("name", "like", "%" . $string . "%")->orWhere('key', 'like', '%' . $string . '%')->limit(20)->orderBy('name', 'asc')->get();
        }
        return $col->map(function ($cie9mc) {
            return [
                'id' => $cie9mc->id,
                'label' => '(' . $cie9mc->key . ') ' . $cie9mc->name
            ];
        });
        return $col->pluck('name', 'id')->toArray();
    }
}
