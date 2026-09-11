<?php

use Illuminate\Database\Seeder;

class ParametrizationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table("parametrization")->insert([
        	"parameter"=>"compra_minimo_requerido",
        	"value"=>"150",
        ]);
    }
}
