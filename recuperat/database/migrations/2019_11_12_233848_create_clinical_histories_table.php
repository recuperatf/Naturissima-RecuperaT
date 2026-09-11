<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->timestamps();
        });
        Schema::table('antecedents', function (Blueprint $table) {
            $table->unsignedBigInteger('clinical_history_id');
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
        Schema::table('clinical_histories', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['patient_id']);
        });
        Schema::table('antecedents', function (Blueprint $table) {
            $table->dropForeign(['clinical_history_id']);
        });
        Schema::dropIfExists('clinical_histories');
    }
}
