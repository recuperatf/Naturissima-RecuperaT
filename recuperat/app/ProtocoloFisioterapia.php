<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProtocoloFisioterapia extends FourPModel
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function diagnosticos(){
    	return $this->belongsToMany('App\CatCIE10','cat_cie10_diagnostico_protocolo_fisioterapia','protocolo_fisioterapia_id','cat_cie10_id');
    }

    public function sintomas(){
    	return $this->belongsToMany('App\CatCIE10', 'cie10_mc_sintomas_protocolo_fisioterapia', 'protocolo_fisioterapia_id','cat_cie10_id');
    }

    public function tratamientos(){
    	return $this->belongsToMany('App\Cie9Mc', 'cie9_mc_tratamientos_protocolo_fisioterapia', 'protocolo_fisioterapia_id','cie9_mc_id');
    }
        public function planes_tratamientos(){
        return $this->belongsToMany('App\Cie9Mc', 'cie9_mc_tratamientos_protocolo_fisioterapia', 'protocolo_fisioterapia_id','cie9_mc_id');
    }
    public function cie10_risk_factors(){
        return $this->belongsToMany('App\CatCIE10', 'cie10_risk_factors', 'protocolo_fisioterapia_id','cat_cie10_id');
    }

    public function cie10_risk_factors_complete(){
        return $this->belongsToMany('App\CatCIE10', 'cie10_risk_factors', 'protocolo_fisioterapia_id','cat_cie10_id')->with('clinic_diagnosis');
    }

    public function cie10_lesions_pf(){
        return $this->belongsToMany('App\CatCIE10', 'cie10_lesions_pf', 'protocolo_fisioterapia_id','cat_cie10_id');
    }

    public function tests_and_meassurements(){
        return $this->belongsToMany('App\DiagnosisPlan', 'tests_meassurements_pf', 'protocolo_fisioterapia_id','diagnosis_plan_id');
    }

    public function keywords(){
    	return $this->belongsToMany('App\Keyword', 'keyword_protocol');
    }

    public function anato_physiology_glosary_item(){
    	return $this->belongsTo('App\AnatoPhysiologyGlosaryItem', 'anato_physiology_glosary_item_id');
    }

    public function getParsedUpdatedAtAttribute(){
        return date('Y/m/d', strtotime($this->updated_at));
    }
}
