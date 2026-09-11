<?php

use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("product_categories")->insert([
            "name"=>"Terapia"
        ]);
        DB::table("product_categories")->insert([
        	"name"=>"Medicamentos",
        	"description"=>"",
            "img"=>"/product_categories/img_medicamentos.jpg",
        ]);
        DB::table("product_categories")->insert([
        	"name"=>"Aromaterapia",
            "description"=>"",
            "img"=>"/product_categories/img_aromaterapia.jpg",
        ]);
        DB::table("product_categories")->insert([
            "name"=>"Productos Naturales",
            "description"=>"",
                "img"=>"/product_categories/img_productos_naturales.jpg",
        ]);
        DB::table("product_categories")->insert([
            "name"=>"Suplementos Alimenticios",
            "description"=>"",
            "img"=>"/product_categories/img_suplementos_alimenticios.jpg",

        ]);
        DB::table("product_categories")->insert([
            "name"=>"Productos ortopédicos",
            "description"=>"",
        ]);
        DB::table("product_categories")->insert([
            "name"=>"Productos para mecanoterapia",
            "description"=>""
        ]);
    }
}
