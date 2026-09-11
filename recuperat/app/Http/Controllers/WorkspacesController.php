<?php

namespace App\Http\Controllers;

use App\ProtocoloFisioterapia;
use App\DiagnosisPlan;
use Illuminate\Http\Request;
use App\CatCIE10;
use App\Http\Controllers\CRUDController;

class WorkspacesController extends CRUDController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(array $attributes = array()){
        parent::__construct();
        $this->index_search_fields = array(
            'name'
        );
        $this->printTableHeader = true;
        $this->index_view = 'workspace.index';
        $this->edit_view = 'workspace.add';
        $this->route_path = 'workspaces';
        $this->route_show = 'workspaces.show';
        $this->class_name = '\App\WorkspacesController';
        $this->model_name = '\App\Workspace';
        $this->short_model_name = 'Workspace';
        $this->A_validator = [
            'name' => 'required',
        ];
        $this->A_validator_messages = [
            'name.required'=>'El campo de nombre es obligatorio',
        ];
        $this->relationships = [
            'laboral_company',
        ];
        $this->file_relationships = [
        ];
        $this->keys = [
            'index' => [
                'name'=>'Nombre',
            ],
            'create' => [
                ['key'=>'name', 'label'=>'Nombre', 'class' => "no_print", 'type'=>'text'],
                'laboral_company'=>[
                  'single' => true,
                  'addRoute' => 'workspaces.create',
                  'viewRoute' => 'workspaces.show',
                  'key'=>'laboral_company',
                  "print"=>true,
                  'label'=>'Empresa',
                  'type'=>'autocompletable_multiple',
                  'class'=>'laboral_company',
                  'name'=>'laboral_company',
                  'url'=>'laboral_company/ajaxGet'
              ],
              ['key'=>'department', 'label'=>'Departamento', 'type'=>'text'],
              ['key'=>'work', 'label'=>'Tarea', 'type'=>'textarea'],
              ['key'=>'asignation', 'label'=>'Asignación', 'type'=>'text'],
              ['key'=>'equipment', 'label'=>'Maquinaria/Equipo', 'type'=>'text'],
            ],
        ];
    }
}
