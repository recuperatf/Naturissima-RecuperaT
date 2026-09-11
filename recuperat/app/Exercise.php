<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $guarded = ['id'];
    public $file_output = 'images/exercise/';
    protected $with = ['exercise_division'];
    public function home_physiotherapy_programs() {
        return $this->belongsToMany('App\HomePhysiotherapyProgram', 'exercise_hpp');
    }

    public function image_resources(){
        return $this->hasMany('App\ImageResource', 'exercise_id', 'id');
    }

    public function video_links () {
        return $this->hasMany('App\VideoLink');
    }

    public function exercise_division() {
        return $this->belongsTo('App\ExcerciseDivision', 'exercise_division_id');
    }
}
