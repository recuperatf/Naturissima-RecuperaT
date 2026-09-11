<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DecisionHpp extends Pivot
{
    public function decision () {
        return $this->belongsTo('App\Decision');
    }
    public function home_physiotherapy_program() {
        return $this->belongsTo('App\HomePhysiotherapyProgram');
    }
}
