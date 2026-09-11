<?php

namespace App\Http\Controllers;

use App\Exercise;
use Storage;
use App\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExerciseController extends CRUDController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(array $attributes = array()){
        parent::__construct();
        $this->index_search_fields = array(
            'description'
        );
        $this->route_path = 'exercise';
        $this->class_name = '\App\ExerciseController';
        $this->model_name = '\App\Exercise';
        $this->short_model_name = 'Exercise';
        $this->file_output = 'images/exercise/';
        $this->A_validator = [
            'description' => 'required',
        ];
        $this->A_validator_messages = [
            'description.required'=>'El campo de nombre es obligatorio',
        ];
        $this->relationships = [
            'home_physiotherapy_programs',
        ];
        $this->file_relationships = [
            'ImageResource'=>'image_resources'
        ];
        $this->keys = [
            'index' => [
                'description'=>'Nombre',
            ],
            'create' => [
                ['key'=>'description', 'label'=>'Nombre', 'type'=>'text'],
                'image_resources'=>['key'=>'image_resources', 'label'=>'Fotografías', 'type' => 'multiple_images'],
                'home_physiotherapy_programs'=>['key'=>'home_physiotherapy_programs', 'label'=>'Programas Fisioterapeuticos en Casa', 'type'=>'autocompletable_multiple', 'class'=>'home_physiotherapy_programs', 'name'=>'home_physiotherapy_programs', 'url'=>'get_home_physiotherapy_program'],
            ],
        ];
    }
    public function apiCreate(Request $request) {
        $aRequest = $request->all();
        $base64Files = $aRequest['imageFiles'];
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        $exercise = new Exercise();
        $exercise->fill($aRequest);
        $exercise->save();
        foreach ($base64Files as $base64File) {
            $extension = pathinfo($base64File['name'], PATHINFO_EXTENSION);
            $image = $base64File['path'];
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace('data:image/jpg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(50).'.'.$extension;
            $imageResource = new ImageResource();
            $imageResource->url = $this->file_output . $imageName;
            $exercise->image_resources()->save($imageResource);
            Storage::put($this->file_output.'/'.$imageName, base64_decode($image));
        }
        return response($exercise->with('image_resources')->find($exercise->id), 200);
    }

    public function apiImageResourcesCreate(Request $request, Exercise $exercise) {
        $aRequest = $request->all();
        dd($aRequest);
        $base64Files = $aRequest['imageFiles'];
        unset($aRequest['imageFiles']);
        unset($aRequest['images']);
        foreach ($base64Files as $base64File) {
            $extension = pathinfo($base64File['name'], PATHINFO_EXTENSION);
            $image = $base64File['path'];
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace('data:image/jpg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(50).'.'.$extension;
            $imageResource = new ImageResource();
            $imageResource->url = $this->file_output . $imageName;
            $exercise->image_resources()->save($imageResource);
            Storage::put($this->file_output.'/'.$imageName, base64_decode($image));
        }
        return response($exercise->with('image_resources')->find($exercise->id), 200);
    }
}

