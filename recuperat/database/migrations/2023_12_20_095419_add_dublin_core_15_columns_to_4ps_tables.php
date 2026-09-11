<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDublinCore15ColumnsTo4psTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_fisioterapias', function (Blueprint $table) {
            $table->string('subject')->nullable();
            $table->string('source')->nullable();
            $table->string('language')->nullable();
            $table->string('relation')->nullable();
            $table->string('coverage')->nullable();
            $table->string('publisher')->nullable();
            $table->string('contributor')->nullable();
            $table->string('rights')->nullable();
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->string('format')->nullable();
            $table->string('identifier')->nullable();
        });
        Schema::table('home_physiotherapy_programs', function (Blueprint $table) {
            $table->string('subject')->nullable();
            $table->string('source')->nullable();
            $table->string('language')->nullable();
            $table->string('relation')->nullable();
            $table->string('coverage')->nullable();
            $table->string('publisher')->nullable();
            $table->string('contributor')->nullable();
            $table->string('rights')->nullable();
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->string('format')->nullable();
            $table->string('identifier')->nullable();
        });
        Schema::table('terapeutic_plans', function (Blueprint $table) {
            $table->string('subject')->nullable();
            $table->string('source')->nullable();
            $table->string('language')->nullable();
            $table->string('relation')->nullable();
            $table->string('coverage')->nullable();
            $table->string('publisher')->nullable();
            $table->string('contributor')->nullable();
            $table->string('rights')->nullable();
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->string('format')->nullable();
            $table->string('identifier')->nullable();
        });
        Schema::table('diagnosis_plans', function (Blueprint $table) {
            $table->string('subject')->nullable();
            $table->string('source')->nullable();
            $table->string('language')->nullable();
            $table->string('relation')->nullable();
            $table->string('coverage')->nullable();
            $table->string('publisher')->nullable();
            $table->string('contributor')->nullable();
            $table->string('rights')->nullable();
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->string('format')->nullable();
            $table->string('identifier')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolo_fisioterapias', function (Blueprint $table) {
            $table->dropColumn('subject');
            $table->dropColumn('source');
            $table->dropColumn('language');
            $table->dropColumn('relation');
            $table->dropColumn('coverage');
            $table->dropColumn('publisher');
            $table->dropColumn('contributor');
            $table->dropColumn('rights');
            $table->dropColumn('date');
            $table->dropColumn('type');
            $table->dropColumn('format');
            $table->dropColumn('identifier');
        });
        Schema::table('home_physiotherapy_programs', function (Blueprint $table) {
            $table->dropColumn('subject');
            $table->dropColumn('source');
            $table->dropColumn('language');
            $table->dropColumn('relation');
            $table->dropColumn('coverage');
            $table->dropColumn('publisher');
            $table->dropColumn('contributor');
            $table->dropColumn('rights');
            $table->dropColumn('date');
            $table->dropColumn('type');
            $table->dropColumn('format');
            $table->dropColumn('identifier');
        });
        Schema::table('terapeutic_plans', function (Blueprint $table) {
            $table->dropColumn('subject');
            $table->dropColumn('source');
            $table->dropColumn('language');
            $table->dropColumn('relation');
            $table->dropColumn('coverage');
            $table->dropColumn('publisher');
            $table->dropColumn('contributor');
            $table->dropColumn('rights');
            $table->dropColumn('date');
            $table->dropColumn('type');
            $table->dropColumn('format');
            $table->dropColumn('identifier');
        });
        Schema::table('diagnosis_plans', function (Blueprint $table) {
            $table->dropColumn('subject');
            $table->dropColumn('source');
            $table->dropColumn('language');
            $table->dropColumn('relation');
            $table->dropColumn('coverage');
            $table->dropColumn('publisher');
            $table->dropColumn('contributor');
            $table->dropColumn('rights');
            $table->dropColumn('date');
            $table->dropColumn('type');
            $table->dropColumn('format');
            $table->dropColumn('identifier');
        });
    }
}
