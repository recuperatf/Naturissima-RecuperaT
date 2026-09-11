<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LaboralTherapeuticPlan extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function image_resources(){
    	return $this->hasMany('App\ImageResource', 'laboral_therapeutic_plan_id','id');
    }
}
