<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;
    protected $guarded=[
    	"id"
    ];
    public function product(){
    	return $this->belongsTo("\App\Product","product_id");
    }
    public function clinic(){
    	return $this->belongsTo("App\Clinic");
    }
    public function getMunicipalityFacturationAttribute($value){
        return (Municipality::find($value))?Municipality::find($value)->name:"";
    }
    public function getStateFacturationAttribute($value){
        return (State::find($value))?State::find($value)->name:"";
    }
    public function getMunicipalitySendAddressAttribute($value){
        return (Municipality::find($value))?Municipality::find($value)->name:"";
    }
    public function getStateSendAddressAttribute($value){
        return (State::find($value))?State::find($value)->name:"";
    }
    public function download_links(){
        return $this->hasMany('App\DownloadLink');
    }
}
