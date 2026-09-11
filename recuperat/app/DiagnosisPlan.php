<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosisPlan extends FourPModel
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function outside_resources(){
    	return $this->hasMany('App\OutsideResource', 'diagnosis_plan_id','id');
    }
    public function image_resources(){
    	return $this->hasMany('App\ImageResource', 'diagnosis_plan_id','id');
    }
    public function keywords(){
    	return $this->belongsToMany('App\Keyword', 'keyword_diagnosis_plan');
    }
    public function anato_physiology_glosary_item(){
    	return $this->belongsTo('App\AnatoPhysiologyGlosaryItem', 'anato_physiology_glosary_item_id');
    }
}
