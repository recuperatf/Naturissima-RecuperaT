<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeightLiftEvaluation extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function getMetadataAttribute($value)
    {
        return json_decode($value);
    }
}
