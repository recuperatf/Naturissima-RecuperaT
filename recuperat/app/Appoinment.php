<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    protected $guarded = [
        "id",
        "created_at",
        "deleted_at"
    ];
    protected $table = "orders";
    public function category()
    {
        return $this->belongsTo("App\AppoinmentCategory", "appoinment_category", "id");
    }

    public function product()
    {
        return $this->belongsTo("App\Product", "product_id", "id");
    }
}
