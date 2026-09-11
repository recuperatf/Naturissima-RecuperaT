<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Product;
class ServicesController extends Controller
{
    public function index(){
    	$C_products=Product::where("active",true)->where("product_category_id",1);
    	if(\Auth::user()){
    	    if(\Auth::user()->rol->id==1){
    	        $C_products=Product::where("product_category_id",1);
    	    }
    	}
			if(($search_terms=request()->search_terms)){
				$C_products=$C_products->where("name","like","%".$search_terms."%");
			}
			$C_products = $C_products->paginate(15);
    	return view("service/index")->with("C_products",$C_products)->with('SESSION_products', session()->get("IDs_cart_products"));
    }
}
