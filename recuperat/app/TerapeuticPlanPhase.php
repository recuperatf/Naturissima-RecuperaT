<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerapeuticPlanPhase extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany('App\TerapeuticPlanPhasesImage');
    }
}
