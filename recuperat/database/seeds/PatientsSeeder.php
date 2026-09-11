<?php

use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
        	'name'=>"Luis Esteban",
        	'surname'=>"Ruelas",
        	'second_surname'=>"Zaragoza",
        	'sex'=>true,
        	'telephone'=>'3339455534',
        	'birth_date'=>'1994-12-22',
        	'birth_state_id'=>14,
        	'birth_municipality_id'=>571,
        	'address'=>'Prado Verde 1262, Los Mochis, Sinaloa'
        ]);
        DB::table('patients')->insert([
            'name'=>"Ana Laura",
            'surname'=>"Ruelas",
            'second_surname'=>"García",
            'sex'=>false,
            'telephone'=>'1234567890',
            'birth_date'=>'1996-11-10',
            'birth_state_id'=>14,
            'birth_municipality_id'=>571,
            'address'=>'Prado Verde 1262, Los Mochis, Sinaloa',
            'occupation'=>'Diseñadora'
        ]);
    }
}
