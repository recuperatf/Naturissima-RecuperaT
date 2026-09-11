<?php

use Illuminate\Database\Seeder;

class DrasRehabiNutriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Dra Cintia',
        	'user_rol_id' => 3,
        	'email'=>'cintia_cardenas@hotmail.com',
        	'password' => bcrypt('159487326')
        ]);
        DB::table('users')->insert([
        	'name' => 'Dra Cari Tellez',
        	'user_rol_id' => 5,
        	'email'=>'caritellez.nutricion@gmail.com',
        	'password' => bcrypt('326159487')
        ]);
    }
}
