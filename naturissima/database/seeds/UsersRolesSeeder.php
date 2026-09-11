<?php

use Illuminate\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_rols')->insert([
            'name' => 'admin'
        ]);
        DB::table('user_rols')->insert([
            'name' => 'medico'
        ]);
        DB::table('user_rols')->insert([
            'name' => 'rehabilitador'
        ]);
        DB::table('user_rols')->insert([
            'name' => 'administrativo'
        ]);
        DB::table('user_rols')->insert([
            'name' => 'pacientes'
        ]);
    }
}
