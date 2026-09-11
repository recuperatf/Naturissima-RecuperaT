<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTratamientosProtocolos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cie9_mc_tratamientos_protocolo_fisioterapia', function (Blueprint $table) {
            $table->integer('protocolo_fisioterapia_id');
            $table->integer('cie9_mc_id');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('protocolo_fisioterapias',function($table){
            $table->string('tratamientos_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolo_fisioterapias',function($table){
            $table->dropColumn('tratamientos_text');
        });
        Schema::dropIfExists('cie9_mc_tratamientos_protocolo_fisioterapia');
    }
}
