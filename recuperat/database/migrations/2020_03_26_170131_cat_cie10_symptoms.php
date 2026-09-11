<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatCie10Symptoms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_cie10s',function($table){
            $table->text('text_injury_mechanism')->nullable();
            $table->text('text_clinic_radiologic_diagnosis')->nullable();
        });
        Schema::create('cat_cie10_symptoms',function($table){
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('child_id');

            $table->foreign('parent_id')->references('id')->on('cat_cie10s');
            $table->foreign('child_id')->references('id')->on('cat_cie10s');
        });

        Schema::create('cat_cie10_clinical_diagnosis',function($table){
            $table->unsignedBigInteger('cat_cie10_id');
            $table->unsignedBigInteger('diagnosis_plan_id');

            $table->foreign('cat_cie10_id')->references('id')->on('cat_cie10s');
            $table->foreign('diagnosis_plan_id')->references('id')->on('diagnosis_plans');
        });

        Schema::create('cat_cie10_radiologic_diagnosis',function($table){
            $table->unsignedBigInteger('cie9mc_id');
            $table->unsignedBigInteger('cat_cie10_id');

            $table->foreign('cat_cie10_id')->references('id')->on('cat_cie10s');
            $table->foreign('cie9mc_id')->references('id')->on('cie9mc');
        });
        Schema::create('cat_cie10_treatments',function($table){
            $table->unsignedBigInteger('cat_cie10_id');
            $table->unsignedBigInteger('terapeutic_plan_id');

            $table->foreign('cat_cie10_id')->references('id')->on('cat_cie10s');
            $table->foreign('terapeutic_plan_id')->references('id')->on('terapeutic_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_cie10s',function($table){
            $table->dropColumn('text_injury_mechanism');
            $table->dropColumn('text_clinic_radiologic_diagnosis');
        });
        Schema::table('cat_cie10_symptoms',function($table){
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['child_id']);
        });
        Schema::table('cat_cie10_clinical_diagnosis',function($table){
            $table->dropForeign(['cat_cie10_id']);
            $table->dropForeign(['diagnosis_plan_id']);
        });
        Schema::table('cat_cie10_radiologic_diagnosis',function($table){
            $table->dropForeign(['cat_cie10_id']);
            $table->dropForeign(['cie9mc_id']);
        });
        Schema::table('cat_cie10_treatments',function($table){
            $table->dropForeign(['cie9mc_id']);
            $table->dropForeign(['terapeutic_plan_id']);
        });


        Schema::dropIfExists('cat_cie10_symptoms');
        Schema::dropIfExists('cat_cie10_clinical_diagnosis');
        Schema::dropIfExists('cat_cie10_radiologic_diagnosis');
        Schema::dropIfExists('cat_cie10_treatments');
    }
}
