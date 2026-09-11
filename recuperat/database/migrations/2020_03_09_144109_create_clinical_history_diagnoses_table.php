<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalHistoryDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_history_diagnoses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cat_cie10_id');
            $table->unsignedBigInteger('clinical_history_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cat_cie10_id')->references('id')->on('cat_cie10s');
            $table->foreign('clinical_history_id')->references('id')->on('clinical_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinical_history_diagnoses', function($table){
            $table->dropForeign(['cat_cie10_id']);
            $table->dropForeign(['clinical_history_id']);
        });
        Schema::dropIfExists('clinical_history_diagnoses');
    }
}
