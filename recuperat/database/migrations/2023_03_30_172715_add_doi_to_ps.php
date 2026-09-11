<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoiToPs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_fisioterapias', function(Blueprint $table) {
            $table->string('doi')->nullable();
        });
        Schema::table('home_physiotherapy_programs', function(Blueprint $table) {
            $table->string('doi')->nullable();
        });
        Schema::table('diagnosis_plans', function(Blueprint $table) {
            $table->string('doi')->nullable();
        });
        Schema::table('terapeutic_plans', function(Blueprint $table) {
            $table->string('doi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolo_fisioterapias', function(Blueprint $table) {
            $table->dropColumn('doi');
        });
        Schema::table('home_physiotherapy_programs', function(Blueprint $table) {
            $table->dropColumn('doi');
        });
        Schema::table('diagnosis_plans', function(Blueprint $table) {
            $table->dropColumn('doi');
        });
        Schema::table('terapeutic_plans', function(Blueprint $table) {
            $table->dropColumn('doi');
        });
    }
}
