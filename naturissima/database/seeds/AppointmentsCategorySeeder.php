<?php

use Illuminate\Database\Seeder;

class AppointmentsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("appoinment_categories")->insert([
        	"name"=>"Consulta Médica"
        ]);
        DB::table("appoinment_categories")->insert([
        	"name"=>"Consulta Naturista"
        ]);
    }
}
