
<?php

use Illuminate\Database\Seeder;

class AppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table("orders")->insert([
    		"buyer_name"=>"Luis Esteban Ruelas Zaragoza",
    		"product_id"=>18,
    		"telephone"=>"3339455534",
            "appoinment_date"=>"2019-11-12 14:00:00",
            "appoinment_patient_name"=>"Un paciente",
    	]);
            DB::table("orders")->insert([
                "buyer_name"=>"Comprador de producto",
                "product_id"=>1,
                "json_report"=>'{"total_price":1600,"products":[{"name":"Remediax","price":200,"description":null,"quantity":"3"},{"name":"Natumex","price":100,"description":null,"quantity":"2"},{"name":"Natumax","price":100,"description":null,"quantity":"4"},{"name":"Organon de Medicina Hanneman","price":100,"description":null,"quantity":"4"}]}',
                "telephone"=>"123456789",
                "delivery"=>true,
            ]);
    }
}
