<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use App\ProductCategory;
class ProductCategoriesController extends CRUDController
{
   public function __construct(array $attributes = array()){
      parent::__construct();

      $this->index_search_fields = array(
          'id', 'name'
      );

      $this->route_path = 'product_categories';
      $this->file_output = 'images/product_categories/';
      $this->class_name = '\App\ProductCategoriesController';
      $this->model_name = '\App\ProductCategory';
      $this->short_model_name = 'ProductCategory';

      // $this->file_output = 'images/plans_images/diagnosis/';
      $this->A_validator = [
          'name' => 'required|unique:product_categories',
      ];
      $this->A_validator_update = [
          'name' => 'required|unique:product_categories,name,{{id}}',
      ];
      $this->A_validator_messages = [
          'name.required'=>'El campo de nombre es obligatorio',
          'name.unique'=>'Ese nombre ya ha sido registrado',
      ];
      $this->A_validator_messages_update = [
          'name.required'=>'El campo de nombre es obligatorio'
      ];
      // $this->relationships = [
      //     'UserRol'=>'rol',
      //     // 'clinic_diagnosis',
      //     // 'radiologic_diagnosis',
      //     // 'treatments',
      // ];
      // $this->file_relationships = [
      //     'ImageResource'=>'image_resources'
      // ];
      $this->keys = [
          'index' => [
              'id'=>'id',
              'name'=>'Nombre'
          ],
          'create' => [
              ['key'=>'name', 'label'=>'Nombre', 'type'=>'text'],
          ],
          'edit' => [
              ['key'=>'name', 'label'=>'Nombre', 'type'=>'text'],
          ],
      ];
  }
   public function viewCategory($ID_product_category){
   	$product_category=ProductCategory::where("id",$ID_product_category)->first();
   	return view("product.category.view_category")->with(compact("product_category"));
   }

   public function storeByCategory($ID_product_category){
   		return view("product.category.view_category_store");
   }
}
