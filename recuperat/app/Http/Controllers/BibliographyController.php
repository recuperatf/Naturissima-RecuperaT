<?php

namespace App\Http\Controllers;

use App\Bibliography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BibliographyController extends CRUDController
{
    /**
     * Display a listing of Bibliography controllers.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(array $attributes = array())
    {
        parent::__construct();

        $this->index_search_fields = array(
            'code',
            'name'
        );
        $this->route_path = 'bibliography';
        $this->class_name = '\App\BibliographyController';
        $this->model_name = '\App\Bibliography';
        $this->short_model_name = 'Bibliography';
        // $this->file_output = 'images/plans_images/diagnosis/';
        $this->A_validator = [
            'title' => 'required',
            'date' => 'nullable|date_format:Y-m-d',
        ];
        $this->A_validator_messages = [
            'name.required' => 'El campo de nombre es obligatorio',
            'date.date_format' => 'La fecha debe estar en formato "AAAA-MM-DD"',
        ];
        $this->relationships = [
            // 'sintomas',
        ];
        $this->file_relationships = [

        ];
        $this->files = [
            'file'
        ];
        $this->keys = [
            'index' => [
                'title' => 'Título',
                'date' => 'Fecha'
            ],
            'user_id' => true,
            'create' => [
                // ['key'=>'drive_info', 'label'=>'Información Drive', 'type'=>'text'],
                ['key' => 'title', 'label' => 'Título', 'type' => 'text'],
                ['key' => 'file', 'label' => 'Archivo', 'type' => 'file'],
                ['key' => 'date', 'label' => 'Fecha', 'type' => 'date'],
                ['key' => 'format', 'label' => 'Formato', 'type' => 'text'],
                ['key' => 'identifier', 'label' => 'Identificador', 'type' => 'text'],
                ['key' => 'language', 'label' => 'Idioma', 'type' => 'text'],
                ['key' => 'description', 'label' => 'Descripción', 'type' => 'text'],
                ['key' => 'coverage', 'label' => 'Coverage', 'type' => 'text'],
                ['key' => 'relation', 'label' => 'Relación', 'type' => 'text'],
                ['key' => 'source', 'label' => 'Fuente', 'type' => 'text'],
                ['key' => 'subject', 'label' => 'Materia', 'type' => 'text'],
                ['key' => 'type', 'label' => 'Tipo', 'type' => 'text'],
                ['key' => 'contributor', 'label' => 'Contribuidor', 'type' => 'text'],
                ['key' => 'creator', 'label' => 'Creador', 'type' => 'text'],
                ['key' => 'publisher', 'label' => 'Publicador(?)', 'type' => 'text'],
                ['key' => 'rights', 'label' => 'Derechos', 'type' => 'text'],
            ]
        ];
    }

    public function downloadBibliography(Request $request, Bibliography $bibliography)
    {
        $files = (Storage::cloud()->allFiles());
        $filename = $bibliography->file;
        $correctId = 0;
        foreach ($files as $file) {
            $file_array = Storage::disk('google')->getAdapter()->getMetadata($file);
            $correctId = $filename == $file_array['filename'] . '.' . $file_array['extension'] ? $file_array['path'] : 0;
            var_dump($filename, $file_array['filename'] . '.' . $file_array['extension']);
            if ($correctId) {
                break;
            }
        }
        return Storage::disk('google')->download($correctId);
    }
    // public function index()
    // {
    //     // $dir = '/';
    //     // $recursive = false; 
    //     // $contents = collect(Storage::cloud()->listContents($dir, $recursive));

    //     // $A_contents=$contents->where('type', '=', 'file'); // files
    //     $A_contents = Bibliography::all();


    //     return view('bibliography.bibliography_index')->with(compact('A_contents'));
    // }

}
