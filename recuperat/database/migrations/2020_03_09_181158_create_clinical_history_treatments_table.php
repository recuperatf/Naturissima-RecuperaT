<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalHistoryTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_history_treatments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cie9_mc_id');
            $table->unsignedBigInteger('clinical_history_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cie9_mc_id')->references('id')->on('cie9mc');
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
        Schema::table('clinical_history_treatments', function($table){
            $table->dropForeign(['cie9_mc_id']);
            $table->dropForeign(['clinical_history_id']);
        });
        Schema::dropIfExists('clinical_history_treatments');
    }
}
