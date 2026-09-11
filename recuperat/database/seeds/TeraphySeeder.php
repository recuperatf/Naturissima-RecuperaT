<?php

use Illuminate\Database\Seeder;

class TeraphySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        	'name'=>'Fisioterapia en traumatología y ortopedia',
        	'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Esguinces, prótesis de cadera, prótesis de rodilla, luxaciones, Fracturas',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Fisioterapia en Reumatología',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Artrosis, coxartrosis, Artritis, gonartrosis',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Fisioterapia en Neurología',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Parálisis facial, parálisis cerebral, Evc, Traumatismo craneoencefalico',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Fisioterapia en Neurocirugías',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Hernias, lumbalgias, dorsalgias, cervicobracalgias, ciatalgias',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Fisioterapia en Lesiones deportivas',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Tendinitis, Bursitis, Fascitis, Periostitis, contusiones, distensiones',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Fisioterapia en Pediatría',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Retrasos en el neurodesarrollo',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);

        DB::table('products')->insert([
            'name'=>'Fisioterapia en Geriatría',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Activación física, Procesos degenerativos',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Fisioterapia en ginecología',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Disfunción del suelo pélvico',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Estética',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Liposucciones',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Fisioterapia de mano',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Neuropatias, síndromes, epicondilitis, epitrocleitis',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Insuficiencia renal',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Lesiones agregadas a la enfermedad, activación física',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Lesión medular',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Paciente amputado',
            'product_category_id'=>1,
            'price_mxn'=>350,
            'active'=>true,
        ]);
    }
}

