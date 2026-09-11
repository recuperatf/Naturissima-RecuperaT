<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class Patient extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
	protected $guarded=["id"];
    protected $append = ['age','full_name'];
    public function getAgeAttribute(){
    	return Carbon::parse($this->attributes['birth_date'])->age;
    }
    public function getFullNameAttribute(){
    	return $this->attributes['name']." ".$this->attributes['surname'].(($this->attributes['second_surname'])?(" ".$this->attributes['second_surname']):"");
    }
    public function clinicalHistory(){
    	return $this->hasOne('App\ClinicalHistory','patient_id','id');
    }
    public function responsible(){
    	return $this->belongsTo('App\User', 'responsible_id');
    }
    public function laboralCompany(){
    	return $this->belongsTo('App\LaboralCompany', 'laboral_company_id');
    }
    public function workspace() {
        return $this->belongsTo('App\Workspace', 'workspace_id');
    }
}
