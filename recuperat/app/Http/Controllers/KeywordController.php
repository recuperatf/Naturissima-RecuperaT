<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeywordController extends CRUDController
{
    public function __construct(array $attributes = array())
    {
        parent::__construct();
        $this->index_search_fields = array(
            'name'
        );

        $this->route_show = 'keywords.show';
        $this->route_path = 'keywords';
        $this->class_name = '\App\KeywordController';
        $this->model_name = '\App\Keyword';
        $this->short_model_name = 'Keyword';
        $this->hide_header = true;
        $this->printTableHeader = false;
        $this->hideImage = true;

        // $this->file_output = 'images/plans_images/diagnosis/';
        $this->A_validator = [
            'name' => 'required|unique:users',
        ];
        $this->A_validator_update = [
            'name' => 'required|unique:users,name,{{id}}',
        ];
        $this->A_validator_messages = [
            'name.required' => 'El campo de nombre es obligatorio',
        ];
        $this->A_validator_messages_update = [
            'name.required' => 'El campo de nombre es obligatorio',
        ];
        $this->relationships = [
        ];
        $this->file_relationships = [
        ];
        $this->permissions = [
            'create' => '*',
            'edit' => '*',
            'delete' => '*'
        ];
        $this->keys = [
            'index' => [
                'id' => 'id',
                'name' => 'Nombre',
            ],
            'create' => [
                ['key' => 'name', 'label' => 'Nombre', 'type' => 'text'],
                ['key' => 'description', 'label' => 'Definición', 'type' => 'textarea', 'rows' => 3],
                ['key' => 'bibliography', 'label' => 'Bibliografía', 'type' => 'textarea', 'rows' => 3],
            ],
            'edit' => [
                ['key' => 'name', 'label' => 'Nombre', 'type' => 'text'],
                ['key' => 'description', 'label' => 'Definición', 'type' => 'textarea', 'rows' => 3],
                ['key' => 'bibliography', 'label' => 'Bibliografía', 'type' => 'textarea', 'rows' => 3],
            ],
        ];
    }

    public function ajaxGet($string = null)
    {
        $col = [];
        if ($string) {
            $col = $this->model_name::where("name", "like", $string ? "%$string%" : "%")->limit(40)->orderBy('name', 'asc')->get();
        } else {
            $col = $this->model_name::where("name", "like", "%")->orderBy('name', 'asc')->get();
        }
        return $col->map(function ($cie10) {
            return [
                'id' => $cie10->id,
                'label' => $cie10->name
            ];
        });
    }
}
