<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalHistoryTreatment extends Model
{
    protected $guarded = ['id'];

    public function treatment(){
    	return $this->belongsTo('App\Cie9Mc', 'cie9_mc_id');
    }

    public function clinicalHistory(){
    	return $this->belongsTo('App\ClinicalHistory', 'clinical_history_id');
    }

    public function getNameAttribute(){
    	return $this->treatment->name;
    }
}
