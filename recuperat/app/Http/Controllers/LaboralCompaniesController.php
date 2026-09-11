<?php

namespace App\Http\Controllers;

use App\DiagnosisPlan;
use Illuminate\Http\Request;
use App\CatCIE10;
use App\Http\Controllers\CRUDController;

class LaboralCompaniesController extends CRUDController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $file_output = 'images/laboral_company/';
    public function __construct(array $attributes = array()){
        parent::__construct();
        $this->index_search_fields = array(
            'name'
        );
        $this->printTableHeader = true;
        $this->route_path = 'laboral_company';
        $this->route_show = 'laboral_company.show';
        $this->class_name = '\App\LaboralCompaniesController';
        $this->model_name = '\App\LaboralCompany';
        $this->short_model_name = 'LaboralCompany';
        $this->A_validator = [
            'name' => 'required',
        ];
        $this->A_validator_messages = [
            'name.required'=>'El campo de nombre es obligatorio',
        ];
        $this->relationships = [
            // 'cie10_risk_factors',
        ];
        $this->file_relationships = [
        ];
        $this->file_relationships = [
            'ImageResource'=>'image_resources'
        ];
        $this->keys = [
            'index' => [
                'name'=>'Nombre',
                'rfc'=>'RFC',
            ],
            'create' => [
                ['key'=>'name', 'label'=>'Nombre', 'class' => "", 'type'=>'text'],
                ['key'=>'social_reason', 'label'=>'Razón social', 'class' => "", 'type'=>'text'],
                ['key'=>'general_office_address', 'label'=>'Dirección de oficinas generales', 'class' => "", 'type'=>'text'],
                ['key'=>'contact_office_address', 'label'=>'Dirección de oficinas de contacto', 'class' => "", 'type'=>'text'],
                ['key'=>'email', 'label'=>'Email', 'class' => "", 'type'=>'text'],
                ['key'=>'webpage', 'label'=>'Página web', 'class' => "", 'type'=>'text'],
                ['key'=>'schedule', 'label'=>'Horario', 'class' => "", 'type'=>'text'],
                ['key'=>'marks', 'label'=>'Marcas', 'class' => "", 'type'=>'text'],
                ['key'=>'rfc', 'label'=>'RFC', 'class' => "", 'type'=>'text'],
                'image_resources'=>['key'=>'image_resources', 'label'=>'Logo', 'type' => 'multiple_images'],
            ],
        ];
    }
    public function index(Request $request)
    {
        $C_model=false;
        if(!empty($request->search_terms)){
            if(!empty($this->index_search_fields)){
                $C_model = $this->model_name::where($this->index_search_fields[0],'like','%'.$request->search_terms.'%');
                unset($this->index_search_fields[0]);
                foreach ($this->index_search_fields as $key => $field) {
                    $C_model->orWhere($field,'like','%'.$request->search_terms.'%');
                }
            }else{
                $C_model = $this->model_name::where('name','like','%'.$request->search_terms.'%');
            }
        }
        if(!empty($request->user_id)){
            $C_model = $this->model_name::where('user_id','!=', null);
        }
        if($C_model!==false){
            return view(!empty($this->index_view) ? $this->index_view : 'nordic.index')->with('C_model',$C_model->paginate(20))->
            with('permissions',!empty($this->permissions)?$this->permissions:[])->
            with('title',!empty($this->title)?$this->title:null)->
            with('keys_to_show',$this->keys['index'])->
            with('route_path', $this->route_path)->
            with('route_show', !empty($this->route_show) ? $this->route_show : false)->
            with('route_search', $this->route_path.'.index')->
            with('route_create',$this->route_path.'.create')->
            with('route_edit',$this->route_path.'.edit')->
            with('route_update',$this->route_path.'.ajaxUpdate')->
            with('route_delete',$this->route_path.'.ajaxDelete');
            with('search_terms',$request->search_terms)->
            with('hide_header',!empty($this->hide_header) ? $this->hide_header : false)->
            with('printTableHeader',!empty($this->printTableHeader) ? $this->printTableHeader : false);
        }else{
            return view(!empty($this->index_view) ? $this->index_view : 'nordic.index')->with('C_model',$this->model_name::paginate(20))->
                with('permissions',!empty($this->permissions)?$this->permissions:[])->
                with('title',!empty($this->title)?$this->title:null)->
                with('keys_to_show',$this->keys['index'])->
                with('route_show', !empty($this->route_show) ? $this->route_show : false)->
                with('route_path', $this->route_path)->
                with('route_search',$this->route_path.'.index')->
                with('route_create',$this->route_path.'.create')->
                with('route_edit',$this->route_path.'.edit')->
                with('route_update',$this->route_path.'.ajaxUpdate')->
                with('route_delete',$this->route_path.'.ajaxDelete')->
                with('search_terms',$request->search_terms)->
                with('hide_header',!empty($this->hide_header) ? $this->hide_header : false)->
                with('printTableHeader',!empty($this->printTableHeader) ? $this->printTableHeader : false);
        }
    }
    public function show($id)
    {
        $model = $this->model_name::where('id',$id)->first();
        if(!empty($this->relationships)){
            foreach ($this->relationships as $key => $relationship_name) {
                if(!empty($this->keys['edit'])){
                    if(empty($this->keys['edit'][$relationship_name]['default'])) {
                        $this->keys['edit'][$relationship_name]['default']=$model->$relationship_name;
                    }
                }else{
                    $collection = $model->$relationship_name;
                    if(!$collection) {
                        unset($this->keys['create'][$relationship_name]['default']);
                        continue;
                    }
                    $this->keys['create'][$relationship_name]['default'] = get_class($collection) == "Illuminate\Database\Eloquent\Collection" ? $model->$relationship_name : collect()->add($model->$relationship_name);
                }
            }
        }
        if(!empty($this->file_relationships)){
            foreach ($this->file_relationships as $key => $relationship_name) {
                if(!empty($this->keys['edit'])){
                    $this->keys['edit'][$relationship_name]['default']=$model->$relationship_name;
                }else{
                    $this->keys['create'][$relationship_name]['default']=$model->$relationship_name;
                }
            }
        }
        return view('nordic.show')->
        with('form_method','put')->
        with('route_prefix',$this->route_path)->
        with('form_url',route($this->route_path.'.store'))->
        with('keys',(!empty($this->keys['edit']))?$this->keys['edit']:$this->keys['create'])->
        with('stop_extend', false)->
        with('patient_id',!empty($this->patient_id)? $this->patient_id : null)->
        with('protocol', $this->class_name == '\App\ProtocoloFisioterapiaController' ? $model : null)->
        with('O_model',$model)->
        with('printTableHeader', !empty($this->printTableHeader) ? $this->printTableHeader : null)->
        with('newVersionRoute', $this->route_path ? $this->route_path.'.new_version'  : null );
    }
}
