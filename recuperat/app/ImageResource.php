<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageResource extends Model
{
    protected $table = 'image_resources';
    protected $guarded = ['id'];
}
