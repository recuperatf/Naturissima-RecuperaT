<?php

use Illuminate\Database\Seeder;
use App\CatCIE10;

class CIE10Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // split the statements, so DB::statement can execute them.
        $content = file_get_contents('cie10.sql');
        $good_content=mb_convert_encoding($content, 'UTF-8',
                 mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
        $statements = array_filter(array_map('trim', explode(';', $good_content)));
        foreach ($statements as $stmt) {
        	$this->command->info($stmt);
            DB::statement($stmt);
        }
        $this->command->info("Se ha terminado de llenar la base de datos con los códigos CIE10");
    }
}
