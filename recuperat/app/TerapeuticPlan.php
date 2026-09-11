<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TerapeuticPlan extends FourPModel
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function outside_resources(){
    	return $this->hasMany('App\OutsideResource', 'terapeutic_plan_id','id');
    }
    public function image_resources(){
    	return $this->hasMany('App\ImageResource', 'terapeutic_plan_id','id');
    }

    public function keywords(){
    	return $this->belongsToMany('App\Keyword', 'keyword_terapeutic_plan');
    }

    public function anato_physiology_glosary_item(){
    	return $this->belongsTo('App\AnatoPhysiologyGlosaryItem', 'anato_physiology_glosary_item_id');
    }

    public function phases(){
    	return $this->hasMany('App\TerapeuticPlanPhase', 'terapeutic_plan_id','id');
    }
}
