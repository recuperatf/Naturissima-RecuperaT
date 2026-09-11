<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
class Cie9Mc extends Model
{
    protected $table = 'cie9mc';
    

        /**
         * The attributes that should be mutated to dates.
         *
         * @var array
         */
        protected $dates = ['deleted_at'];
        protected $guarded = ['id'];

        public function getCodePlusNameAttribute($value){
        return "(".$this->code.") ".$this->name;
    }

}
