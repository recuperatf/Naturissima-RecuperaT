<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutsideResource extends Model
{
    protected $table = 'outside_resources';
    protected $guarded = ['id'];
}
