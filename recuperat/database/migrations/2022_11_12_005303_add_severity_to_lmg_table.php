<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeverityToLmgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_fisioterapia_l_m_g_s', function (Blueprint $table) {
            $table->text('mild_phisiotherapy_sesions')->nullable()->change();
            $table->string('mild_phisiotherapy_time')->nullable()->change();
            $table->string('mild_phisiotherapy_number_of_sesions')->nullable()->change();
            $table->text('moderate_phisiotherapy_sesions')->nullable()->change();
            $table->string('moderate_phisiotherapy_time')->nullable()->change();
            $table->string('moderate_phisiotherapy_number_of_sesions')->nullable()->change();
            $table->text('severe_phisiotherapy_sesions')->nullable()->change();
            $table->string('severe_phisiotherapy_time')->nullable()->change();
            $table->string('severe_phisiotherapy_number_of_sesions')->nullable()->change();
            $table->boolean('mild')->default(false);
            $table->boolean('moderate')->default(false);
            $table->boolean('severe')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lmg', function (Blueprint $table) {
            //
        });
    }
}
