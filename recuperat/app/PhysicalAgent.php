<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhysicalAgent extends Model
{
    protected $guarded = ['id'];
    public $file_output = 'images/physical_agent/';
    public function home_physiotherapy_programs() {
        return $this->belongsToMany('App\HomePhysiotherapyProgram', 'hpp_physical_agent');
    }

    public function image_resources(){
        return $this->hasMany('App\ImageResource', 'physical_agent_id', 'id');
    }
}
