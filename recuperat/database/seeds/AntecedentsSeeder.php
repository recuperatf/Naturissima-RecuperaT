<?php

use Illuminate\Database\Seeder;

class AntecedentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('antecedent_types')->insert([
        	"name"=>"Patológico"
        ]);
        DB::table('antecedent_types')->insert([
        	"name"=>"No Patológico"
        ]);
        DB::table('antecedent_types')->insert([
        	"name"=>"Heredo-Familiar"
        ]);
    }
}
