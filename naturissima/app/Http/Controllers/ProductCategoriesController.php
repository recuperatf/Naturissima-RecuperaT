<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use App\ProductCategory;
class ProductCategoriesController extends Controller
{
   public function viewCategory($ID_product_category){
   	$product_category=ProductCategory::where("id",$ID_product_category)->first();
   	return redirect()->action('ProductController@index', ['product_category_id' => $ID_product_category]);
   	// return view("product.category.view_category")->with(compact("product_category"));
   }

   public function storeByCategory($ID_product_category){
   		return view("product.category.view_category_store");
   }
}
