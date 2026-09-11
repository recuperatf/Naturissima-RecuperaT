<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadLink extends Model
{
    protected $table = 'download_links';
    protected $guarded = 'id';

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
