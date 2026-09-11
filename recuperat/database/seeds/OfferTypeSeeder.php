<?php

use Illuminate\Database\Seeder;

class OfferTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("offer_types")->insert(
        	["name"=>"various_products_to_one_price",
        	        	"human_name"=>"Varios productos a un precio"]
        );
        DB::table("offer_types")->insert(
        	["name"=>"percentage_off_in_product",
        	        	"human_name"=>"descuento por % en prodcuto"]
        );
    }
}
