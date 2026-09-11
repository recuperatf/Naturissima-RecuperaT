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
    	$this->call(UsersRolesSeeder::class);
    	$this->call(UsersSeeder::class);
        $this->call(ProductCategoriesSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(GeographicSeeder::class);
        $this->call(AppointmentsSeeder::class);
        $this->call(OfferTypeSeeder::class);
        $this->call(OfferSeeder::class);
        $this->call(PatientsSeeder::class);
        $this->call(AntecedentsSeeder::class);
        $this->call(CIE10Seeder::class);
        $this->call(Cie9_mcSeeder::class);
    }
}
