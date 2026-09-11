<?php

use Illuminate\Database\Seeder;

class GeographicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(EntidadesTableSeeder::class);
    	$this->call(MunicipiosTableSeeder::class);
    }
}
