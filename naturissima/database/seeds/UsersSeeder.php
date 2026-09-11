<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Luis Ruelas',
            'email' => 'luise.ruelasz@gmail.com',
            'password' => Hash::make("123456"),
            'created_at'=> date('Y-m-d', time()), 
            'user_rol_id'=> 1 
        ]);
        DB::table('users')->insert([
            'name' => 'Rocío Gomez',
            'email' => 'rocio_gomez@naturissima.com',
            'password' => Hash::make("123456"),
            'created_at'=> date('Y-m-d', time()), 
            'user_rol_id'=> 1 
        ]);
        DB::table('users')->insert([
            'name' => 'Rocío Gomez',
            'email' => 'luis_gomez@naturissima.com',
            'password' => Hash::make("123456"),
            'created_at'=> date('Y-m-d', time()), 
            'user_rol_id'=> 1 
        ]);
    }
}
