<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
    	'name',
    	'img',
    	'description',
        'price_mxn',
        'file',
        'product_category_id',
        'active',
    ];
    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = (int) $value;
    }

    public function getIsDownloadableAttribute($value){
        return $this->product_category_id == 6;
    }

    public static function generateRandomCode(){
            $length = 50;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;

    }

    public function download_links(){
        if(!$this->is_downloadable){
            return;
        }
        return $this->hasMany('App\DownloadLink');
    }

    public function product_category(){
        return $this->belongsTo("App\ProductCategory","product_category_id");
    }
    public static function getProductByIds($array){
        if(!$array){
            return [];
        }
		$Selector_products=[];
    	foreach($array as $key=>$value){
    	    if(!$Selector_products){
    	        $Selector_products=static::where("id","=",$key);
    	        continue;
    	    }
    	    $Selector_products->orWhere("id","=",$key);
    	}
    	return $Selector_products?$Selector_products->get():[];
    }

    public static function getFinalCheckoutReport($products=false){
        $checkout_acceptance_report=[];
        if($products){
            $checkout_acceptance_report["total_price"]=0;
            $checkout_acceptance_report["products"]=[];
            foreach (session()->get("IDs_cart_products") as $key => $array) {
                $product=self::find($key);
                $checkout_acceptance_report["total_price"]+=$product->price_mxn*$products[$key]["qty"];
                $checkout_acceptance_report["products"][]=[
                    "name"=>$product->name, 
                    "price"=>$product->price_mxn, 
                    "description"=>$product->description, 
                    "quantity"=>$products[$key]["qty"],
                    "id"=>$product->id,
                ];
            }
        }
        return $checkout_acceptance_report;
    }
}
