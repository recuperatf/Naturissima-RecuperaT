<?php

use Illuminate\Database\Seeder;

class UserNutriologoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'=>'Nutriologomán',
        	'email'=>'nutriologia@recuperat.com',
        	'user_rol_id'=>5,
        	'email_verified_at'=>date(now()),
        	'password'=>Hash::make('123456'),
        ]);
    }
}
