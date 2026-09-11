<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Patient;
use \App\Antecedent;
use \App\AntecedentType;
use \App\ClinicalHistoryDiagnosis;
use \App\Valoration;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Auth;

class ClinicalRehabilitationNote extends Model
{
    protected $guarded=['id'];
    public function patient(){
    	return $this->belongsTo('App\Patient','patient_id','id');
    }
    public function getLastNoteAttribute(){
        return $this->where('clinical_history_id', $this->clinical_history_id)->where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }
    public function getNextNoteAttribute(){
        return $this->where('clinical_history_id', $this->clinical_history_id)->where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }
    public function clinical_history(){
    	return $this->belongsTo('App\ClinicalHistory');
    }
}
