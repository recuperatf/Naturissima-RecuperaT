<?php

use Illuminate\Database\Seeder;
use App\CatCIE10;

class uncapitalizeCIE10 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (CatCIE10::all() as $cie10) {
            $name = $cie10->name;
            $name = strtolower($name);
            $name[0] = strtoupper($name[0]);
            $cie10->name = $name;
            $cie10->save();
        }
    }
}
