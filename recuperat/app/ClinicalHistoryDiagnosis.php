<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalHistoryDiagnosis extends Model
{
    protected $guarded = ['id'];

    public function diagnosis(){
    	return $this->belongsTo('App\CatCIE10', 'cat_cie10_id');
    }

    public function clinicalHistory(){
    	return $this->belongsTo('App\ClinicalHistory', 'clinical_history_id');
    }
}
