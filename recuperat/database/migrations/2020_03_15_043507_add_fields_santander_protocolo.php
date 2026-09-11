<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsSantanderProtocolo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_fisioterapias', function($table){
            $table->string('objective');
            $table->string('reach');
            $table->string('inclusion_criteria_text');
            $table->string('prognosis');
            $table->string('clinical_diagnosis_explanation');
        });
        Schema::create('cie10_inclusion_criteria_pf', function($table){
            $table->unsignedBigInteger('cat_cie10_id');
            $table->unsignedBigInteger('protocolo_fisioterapia_id');

            $table->foreign('cat_cie10_id')->references('id')->on('cat_cie10s');
            $table->foreign('protocolo_fisioterapia_id')->references('id')->on('protocolo_fisioterapias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolo_fisioterapias', function($table){
            $table->dropColumn('objective');
            $table->dropColumn('reach');
            $table->dropColumn('inclusion_criteria_text');
            $table->dropColumn('prognosis');
            $table->dropColumn('clinical_diagnosis_explanation');
        });
        Schema::table('cie10_inclusion_criteria_pf', function($table){
            $table->dropForeign(['protocolo_fisioterapia_id']);
            $table->dropForeign(['cat_cie10_id']);
            $table->dropIfExists(['cie10_inclusion_criteria_pf']);
        });
        
    }
}
