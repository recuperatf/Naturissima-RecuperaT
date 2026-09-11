<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
    protected $guarded = ["id"];
    public function type()
    {
        return $this->belongsTo("App\OfferType", "offer_type_id");
    }
    public function products()
    {
        return $this->belongsToMany("App\Product", "offer_product", "offer_id", "product_id")->withPivot("qty");
    }
    public function getConditionsAttribute()
    {
        return json_decode($this->json_conditions);
    }

    public function getEndDateAttribute()
    {
        $optionalEndDate = optional($this->conditions)->end_date;
        if (!$optionalEndDate) {
            return null;
        }
        return Carbon::parse($optionalEndDate);
    }

    public function getStartDateAttribute()
    {
        $optionalStartDate = optional($this->conditions)->start_date;
        if (!$optionalStartDate) {
            return null;
        }
        return Carbon::parse($optionalStartDate);
    }
}
