<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocoloFisioterapiaCatCie10Diagnostico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_cie10_diagnostico_protocolo_fisioterapia', function (Blueprint $table) {
            $table->integer('protocolo_fisioterapia_id');
            $table->integer('cat_cie10_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_cie10_diagnostico_protocolo_fisioterapia');
    }
}
