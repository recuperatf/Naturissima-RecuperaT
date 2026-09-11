<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function session_objective() {
        $this->belongsTo('App\SessionObjective');
    }

    public function getDateAttribute($date) {
        return $date ? str_replace(" ","T", substr($date, 0, 16)) : str_replace(" ", "T", substr($this->updated_at, 0, 16));
    }

    public function clinical_history() {
        return $this->belongsTo('App\ClinicalHistory');
    }
}
