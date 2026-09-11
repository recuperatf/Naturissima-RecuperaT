<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsSantanderProtocolo2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_fisioterapias', function($table){
            $table->string('abbreviations')->nullable();
            $table->string('text_risk_factors')->nullable();
            $table->string('text_lesions')->nullable();
            $table->string('clinical_history')->nullable();
            $table->string('text_revision_systems')->nullable();
            $table->string('text_test_and_meassurements')->nullable();
            $table->string('phisiotherapeutic_diagnosis')->nullable();

            $table->string('objective')->nullable()->change();
            $table->string('reach')->nullable()->change();
            $table->string('inclusion_criteria_text')->nullable()->change();
            $table->string('prognosis')->nullable()->change();
            $table->string('clinical_diagnosis_explanation')->nullable()->change();
        });
        Schema::create('cie10_risk_factors', function($table){
            $table->unsignedBigInteger('cat_cie10_id');
            $table->unsignedBigInteger('protocolo_fisioterapia_id');

            $table->foreign('cat_cie10_id')->references('id')->on('cat_cie10s');
            $table->foreign('protocolo_fisioterapia_id')->references('id')->on('protocolo_fisioterapias');
        });
        Schema::create('cie10_lesions_pf', function($table){
            $table->unsignedBigInteger('cat_cie10_id');
            $table->unsignedBigInteger('protocolo_fisioterapia_id');

            $table->foreign('cat_cie10_id')->references('id')->on('cat_cie10s');
            $table->foreign('protocolo_fisioterapia_id')->references('id')->on('protocolo_fisioterapias');
        });

        Schema::create('tests_meassurements_pf', function($table){
            $table->unsignedBigInteger('diagnosis_plan_id');
            $table->unsignedBigInteger('protocolo_fisioterapia_id');

            $table->foreign('diagnosis_plan_id')->references('id')->on('diagnosis_plans');
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
            $table->dropColumn('abbreviations');
            $table->dropColumn('text_risk_factors');
            $table->dropColumn('text_lesions');
            $table->dropColumn('clinical_history');
            $table->dropColumn('text_revision_systems');
            $table->dropColumn('text_test_and_meassurements');
            $table->dropColumn('phisiotherapeutic_diagnosis');
        });
        Schema::table('cie10_risk_factors', function($table){
            $table->dropForeign(['cat_cie10_id']);
            $table->dropForeign(['protocolo_fisioterapia_id']);
        });
        Schema::table('cie10_lesions_pf', function($table){
            $table->dropForeign(['cat_cie10_id']);
            $table->dropForeign(['protocolo_fisioterapia_id']);
        });
        Schema::table('tests_meassurements_pf', function($table){
            $table->dropForeign(['diagnosis_plan_id']);
            $table->dropForeign(['protocolo_fisioterapia_id']);
        });
        Schema::dropIfExists('cie10_risk_factors');
        Schema::dropIfExists('cie10_lesions_pf');
        Schema::dropIfExists('tests_meassurements_pf');
    }
}
