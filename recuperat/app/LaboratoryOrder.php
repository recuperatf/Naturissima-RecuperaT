<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryOrder extends Model
{
    protected $protected = ['id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function patient() {
        return $this->belongsTo('App\Patient');
    }
}
