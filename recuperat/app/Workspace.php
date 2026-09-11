<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $guarded = ['id'];

    public function laboral_company() {
      return $this->belongsTo('App\LaboralCompany');
    }

    public function job_analysis() {
      return $this->hasMany('App\JobAnalysis', '');
    }
}
