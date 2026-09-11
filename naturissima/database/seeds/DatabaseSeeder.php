<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(ParametrizationSeed::class);
        $this->call(UsersRolesSeeder::class);
    	$this->call(UsersSeeder::class);
        $this->call(ProductCategoriesSeeder::class);
        $this->call(ProductsFernando::class);
        // $this->call(ProductSeeder::class);
        $this->call(GeographicSeeder::class);
        $this->call(AppointmentsSeeder::class);
    }
}
