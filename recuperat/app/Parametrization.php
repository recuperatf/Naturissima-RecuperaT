<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Parametrization extends Model
{
	protected $dates = ['deleted_at'];
	protected $guarded= ['id'];
}
    
