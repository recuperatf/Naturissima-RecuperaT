<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSintomasProtocolos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cie10_mc_sintomas_protocolo_fisioterapia', function (Blueprint $table) {
            $table->integer('protocolo_fisioterapia_id');
            $table->integer('cat_cie10_id');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('protocolo_fisioterapias',function($table){
            $table->string('sintomas_text')->nullable();
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
            $table->dropColumn('sintomas_text');
        });
        Schema::dropIfExists('cie10_mc_sintomas_protocolo_fisioterapia');
    }
}
