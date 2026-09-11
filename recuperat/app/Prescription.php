<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $guarded = ['id'];
    public $file_output = 'images/prescription/';
    public function home_physiotherapy_programs() {
        return $this->belongsToMany('App\HomePhysiotherapyProgram', 'hpp_prescription');
    }

    public function image_resources(){
        return $this->hasMany('App\ImageResource', 'prescription_id', 'id');
    }
}
