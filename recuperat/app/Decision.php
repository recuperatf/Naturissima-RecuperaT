<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    protected $guarded = ['id'];

    public function home_physiotherapy_programs() {
        return $this->belongsToMany('App\HomePhysiotherapyProgram', 'decision_hpp')->withPivot('password');
    }
    public function clinic() {
        return $this->belongsTo('App\Clinic', 'clinic_id');
    }
    public function patient() {
        return $this->belongsTo('App\Patient');
    }

    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
