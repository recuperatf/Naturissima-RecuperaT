<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Valoration extends Model
{
	use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['updated_at', 'created_at'];

    public function getJsonValuesAttribute($value){
        if (Str::startsWith($value,'{') || Str::startsWith($value,'[')) {
            return json_decode($value);
        }
    	return $value;
    }
    public function setJsonValuesAttribute($value){
        if (Str::startsWith($value,'{') || Str::startsWith($value,'[')) {
            $this->attributes['json_values'] = json_encode($value);
        }
    	$this->attributes['json_values'] = $value;
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function clinical_history(){
    	return $this->belongsTo('App\ClinicalHistory');
    }
}
