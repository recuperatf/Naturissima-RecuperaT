<?php

use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table("offers")->insert(
    		[
    			"name"=>"10 consultas a 1000 pesos",
    			"offer_type_id"=>1,
    			"json_conditions"=>'{"end_date": "2019-12-31","start_date": "2019-01-01","week_days": {"Lunes":"on","Martes":"on"},"value":1000}'	
    			]
    		);
        DB::table("offer_product")->insert(
            ["offer_id"=>1,
                "product_id"=>1,
                "qty"=>10
            ]
        );
    }
}
