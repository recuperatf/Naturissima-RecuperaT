<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateTableClinicalPhysiotherapyNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clinical_physiotherapy_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clinical_history_id');
            $table->text('json_values');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::create('clinical_physiotherapy_notes', function (Blueprint $table) {
            $table->dropForeign(['clinical_history_id']);
        });
    }
}
