<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboralCompany extends Model
{
    protected $guarded = ['id'];
    public $file_output = 'images/laboral_company/';
    public function workspaces() {
        return $this->hasMany('App\Workspace');
    }

    public function image_resources(){
        return $this->hasMany('App\ImageResource', 'laboral_company_id');
    }
}
