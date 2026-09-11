<?php

namespace App\Http\Controllers;

use App\DiagnosisPlan;
use Illuminate\Http\Request;
use \App\Http\Controllers\CRUDController;
use Illuminate\Support\Facades\Validator;

class DiagnosisPlanController extends CRUDController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct();

        $this->printTableHeader = true;
        $this->route_path = 'diagnosis_plan';
        $this->title = 'Pruebas y medidas funcionales';
        $this->class_name = '\App\DiagnosisPlanController';
        $this->model_name = '\App\DiagnosisPlan';
        $this->short_model_name = 'DiagnosisPlan';
        $this->file_output = 'images/plans_images/diagnosis/';
        $this->relationships = [
            'OutsideResource' => 'outside_resources',
            'Keyword' => 'keywords',
            'anato_physiology_glosary_item',
        ];
        $this->index_search_fields = array(
            'name',
            'keywords'
        );
        $this->A_validator = [
            'name' => 'required',
            // 'description' => 'required'
        ];
        $this->A_validator_messages = [
            'name.required' => 'El campo de nombre es obligatorio',
            'description.required' => 'El campo de descripción es obligatorio',
        ];
        $this->file_relationships = [
            'ImageResource' => 'image_resources'
        ];
        $this->permissions = [
            'create' => 'diagnosis_plans.create',
            'edit' => 'diagnosis_plans.edit',
            'delete' => 'diagnosis_plans.delete'
        ];
        $this->keys = [
            'index' => [
                'name' => 'Nombre',
                'description' => 'Descripción',
                'is_sealed_text' => 'Sellado',
            ],
            'create' => [
                'name' => ['key' => 'name', 'label' => 'Nombre', 'type' => 'text', "class" => 'no_print'],
                'anato_physiology_glosary_item' => [
                    'single' => true,
                    'addRoute' => 'anato_physiology_glosary_item.create',
                    'key' => 'anato_physiology_glosary_item',
                    "print" => true,
                    'label' => 'Categoría anatómica/fisiológica',
                    'type' => 'autocompletable_multiple',
                    'class' => 'anato_physiology_glosary_item',
                    'name' => 'anato_physiology_glosary_item',
                    'url' => 'anato_physiology_glosary_item/ajaxGet'
                ],
                'keywords' => [
                    'single' => false,
                    'addRoute' => 'keywords.create',
                    'key' => 'keywords',
                    'label' => 'Palabras Clave',
                    'type' => 'autocompletable_multiple',
                    'class' => 'autocompletable_cie10_lesions',
                    'name' => 'keywords',
                    'url' => 'keywords/ajaxGet'
                ],
                'pages' => ['key' => 'pages', 'label' => 'Páginas', 'type' => 'text', "class" => "no_print"],
                'version' => ['key' => 'version', 'label' => 'Version', 'type' => 'text', "class" => "no_print"],
                'code' => ['key' => 'code', 'label' => 'Clave', 'type' => 'text', "class" => "no_print"],
                'author' => ['key' => 'made_by', 'label' => 'Elaborado por', 'type' => 'text', "class" => "no_print"],
                'revisor' => ['key' => 'revised_by', 'label' => 'Revisor', 'type' => 'text', "class" => "no_print"],
                'description' => ['key' => 'description', 'label' => 'Descripción', 'type' => 'textarea'],
                'outside_resources' => ['key' => 'outside_resources', 'label' => 'Enlaces externos', 'type' => 'multiple_urls'],
                'image_resources' => ['key' => 'image_resources', 'label' => 'Imágenes. Tests. Pruebas. Medidas funcionales.', 'type' => 'multiple_images'],
                'bibliography' => ['key' => 'bibliography', 'label' => 'Bibliografía', 'type' => 'textarea', 'rows' => '3'],
                ['key' => 'is_sealed', 'label' => 'Sellar versión', 'type' => 'checkbox', "print" => false],

                //Dublin core
                ['onlyAdmin' => true, 'label' => 'Dublin core', 'no_count' => true, 'class' => 'no_print', 'type' => 'separator', 'tag' => 'h4', "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'abstract', 'label' => 'DC.Resumen', 'type' => 'textarea', 'rows' => 5, "print" => false],

                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'subject', 'label' => 'DC.Tema', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'source', 'label' => 'DC.Fuente', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'language', 'label' => 'DC.Idioma', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'relation', 'label' => 'DC.Relación', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'coverage', 'label' => 'DC.Cobertura', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'publisher', 'label' => 'DC.Editor', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'contributor', 'label' => 'DC.Colaboradores', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'rights', 'label' => 'DC.Derechos', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'date', 'label' => 'DC.Fecha', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'type', 'label' => 'DC.Tipo', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'format', 'label' => 'DC.Formato', 'type' => 'textarea', 'rows' => 1, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'identifier', 'label' => 'DC.Identificador', 'type' => 'textarea', 'rows' => 1, "print" => false],

                // ['class'=>'no_print', 'onlyAdmin' => true, 'key'=>'description', 'label'=>'DC.Descripción', 'type'=>'textarea', 'rows'=> 5, "print"=>false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'creator', 'label' => 'DC.Creador', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'date_issued', 'label' => 'DC.Fecha de emisión', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'latest_version', 'label' => 'DC.Última versión', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'version_history', 'label' => 'DC.Historial de versiones', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'document_status', 'label' => 'DC.Estatus del documento', 'type' => 'textarea', 'rows' => 5, "print" => false],
                ['class' => 'no_print', 'onlyAdmin' => true, 'key' => 'doi', 'label' => 'DC.DOI', 'type' => 'textarea', 'rows' => 1, "print" => false],
            ]
        ];
    }
    // public function show($id){
    //     return view('CRUDViews.view')->with('O_model', DiagnosisPlan::with('outside_resources')->with('image_resources')->find($id));
    // }
    public function newVersion($id)
    {
        $diagnosisPlan = DiagnosisPlan::find($id);
        $newdiagnosisPlan = $diagnosisPlan->replicate();
        $newdiagnosisPlan->is_sealed = false;
        $newdiagnosisPlan->name = $newdiagnosisPlan->name . "($newdiagnosisPlan->id)";
        $newdiagnosisPlan->save();
        return redirect(route('diagnosis_plan.edit', $newdiagnosisPlan->id));
    }
}
