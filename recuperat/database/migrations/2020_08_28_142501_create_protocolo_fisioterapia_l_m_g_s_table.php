<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocoloFisioterapiaLMGSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolo_fisioterapia_l_m_g_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->text('mild_phisiotherapy_sesions');
            $table->string('mild_phisiotherapy_time');
            $table->string('mild_phisiotherapy_number_of_sesions');
            $table->text('moderate_phisiotherapy_sesions');
            $table->string('moderate_phisiotherapy_time');
            $table->string('moderate_phisiotherapy_number_of_sesions');
            $table->text('severe_phisiotherapy_sesions');
            $table->string('severe_phisiotherapy_time');
            $table->string('severe_phisiotherapy_number_of_sesions');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolo_fisioterapia_l_m_g_s', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('protocolo_fisioterapia_l_m_g_s');
    }
}
