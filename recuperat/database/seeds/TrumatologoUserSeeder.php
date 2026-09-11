<?php

use Illuminate\Database\Seeder;

class TrumatologoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'=>'Traumatologomán',
        	'email'=>'traumatologia@recuperat.com',
        	'user_rol_id'=>2,
        	'email_verified_at'=>date(now()),
        	'password'=>Hash::make('123456'),
        ]);
    }
}
