<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
// use Illuminate\Database\Eloquent\SoftDeletes;
class JobAnalysis extends Model
{
    // use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'job_analysis';
	protected $guarded=["id"];
    public function patient(){
    	return $this->belongsTo('App\Patient');
    }
    public function workspace(){
    	return $this->belongsTo('App\Workspace');
    }
}
