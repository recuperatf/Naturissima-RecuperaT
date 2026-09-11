<?php

use Illuminate\Database\Seeder;

class ProductSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("products")->insert([
        	"name"=>"Paracetamol",
        	"price_mxn"=>"20",
        	"active"=>true,
        	"product_category_id"=>1
        ]);
        DB::table("products")->insert([
            "name"=>"Lavanda",
            "price_mxn"=>"30",
            "active"=>true,
            "product_category_id"=>2
        ]);
        DB::table("products")->insert([
            "name"=>"Natumax",
            "price_mxn"=>"100",
            "active"=>true,
            "product_category_id"=>3
        ]);
        DB::table("products")->insert([
            "name"=>"GNC-1008",
            "price_mxn"=>"1800",
            "active"=>true,
            "product_category_id"=>4
        ]);
        DB::table("products")->insert([
            "name"=>"Manzanilla",
            "price_mxn"=>"5",
            "active"=>true,
            "product_category_id"=>5
        ]);
        DB::table("products")->insert([
            "name"=>"PDF Herbolaria Hanneman",
            "price_mxn"=>"90",
            "active"=>true,
            "product_category_id"=>6
        ]);
        DB::table("products")->insert([
            "name"=>"Remediax",
            "price_mxn"=>"200",
            "active"=>true,
            "product_category_id"=>7
        ]);
        DB::table("products")->insert([
            "name"=>"Curso Herbolaria",
            "price_mxn"=>"2000",
            "active"=>true,
            "product_category_id"=>8
        ]);
        DB::table("products")->insert([
            "name"=>"Consulta naturista",
            "price_mxn"=>"500",
            "active"=>true,
            "product_category_id"=>9
        ]);



        DB::table("products")->insert([
            "name"=>"Clopidogrel",
            "price_mxn"=>"200",
            "active"=>true,
            "product_category_id"=>1
        ]);
        DB::table("products")->insert([
            "name"=>"Flor de la paz",
            "price_mxn"=>"30",
            "active"=>true,
            "product_category_id"=>2
        ]);
        DB::table("products")->insert([
            "name"=>"Natumex",
            "price_mxn"=>"100",
            "active"=>true,
            "product_category_id"=>3
        ]);
        DB::table("products")->insert([
            "name"=>"GNP-400",
            "price_mxn"=>"1600",
            "active"=>true,
            "product_category_id"=>4
        ]);
        DB::table("products")->insert([
            "name"=>"Ruda",
            "price_mxn"=>"4",
            "active"=>true,
            "product_category_id"=>5
        ]);
        DB::table("products")->insert([
            "name"=>"Organon de Medicina Hanneman",
            "price_mxn"=>"100",
            "active"=>true,
            "product_category_id"=>6
        ]);
        DB::table("products")->insert([
            "name"=>"Natural remedy",
            "price_mxn"=>"250",
            "active"=>true,
            "product_category_id"=>7
        ]);
        DB::table("products")->insert([
            "name"=>"Curso Flores de Bach",
            "price_mxn"=>"2000",
            "active"=>true,
            "product_category_id"=>8
        ]);
        DB::table("products")->insert([
            "name"=>"Orientación Naturista",
            "price_mxn"=>"200",
            "active"=>true,
            "product_category_id"=>9
        ]);
    }
}
