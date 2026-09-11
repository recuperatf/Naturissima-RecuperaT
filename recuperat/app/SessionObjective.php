<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SessionObjective extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function session_objective() {
        $this->belongsTo('App\Session');
    }
}
