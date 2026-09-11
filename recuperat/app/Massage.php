<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Massage extends Model
{
    protected $guarded = ['id'];
    public $file_output = 'images/massage/';
    public function home_physiotherapy_programs() {
        return $this->belongsToMany('App\HomePhysiotherapyProgram', 'hpp_massage');
    }

    public function image_resources(){
        return $this->hasMany('App\ImageResource', 'massage_id', 'id');
    }
}
