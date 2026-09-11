<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contraindication extends Model
{
    protected $guarded = ['id'];
    public $file_output = 'images/contraindication/';
    public function home_physiotherapy_programs() {
        return $this->belongsToMany('App\HomePhysiotherapyProgram', 'contraindication_hpp');
    }

    public function image_resources(){
        return $this->hasMany('App\ImageResource', 'contraindication_id', 'id');
    }
}
