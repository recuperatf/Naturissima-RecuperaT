<?php

namespace App\Http\Controllers;

use App\ProtocoloFisioterapia;
use App\DiagnosisPlan;
use Illuminate\Http\Request;
use App\CatCIE10;
use App\Http\Controllers\CRUDController;

class AnatoPhysiologyGlosaryItemsController extends CRUDController
{
    /**
     * Display a listing of the Anato Physiology Glosary Items "Diccionario de anatomía y Fisiología".
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct();
        $this->index_search_fields = array(
            'name'
        );
        $this->printTableHeader = false;
        $this->hideImage = true;
        $this->route_path = 'anato_physiology_glosary_item';
        $this->route_show = 'anato_physiology_glosary_item.show';
        $this->class_name = '\App\AnatoPhysiologyGlosaryItemsController';
        $this->model_name = '\App\AnatoPhysiologyGlosaryItem';
        $this->short_model_name = 'AnatoPhysiologyGlosaryItem';
        $this->file_output = 'images/anato_physiology_glosary_item/';
        $this->A_validator = [
            'name' => 'required',
        ];
        $this->A_validator_messages = [
            'name.required' => 'El campo de nombre es obligatorio',
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
            ]
        ];
    }

    /** 
     * Get the specified Anato Physiology Glosary from storage.
     */

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
