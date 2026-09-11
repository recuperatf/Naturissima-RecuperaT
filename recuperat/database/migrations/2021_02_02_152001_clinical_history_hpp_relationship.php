<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClinicalHistoryHppRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decision_hpp', function ($table) {
            $table->unsignedBigInteger('decision_id');
            $table->unsignedBigInteger('home_physiotherapy_program_id');

            $table->foreign('decision_id')->references('id')->on('decisions');
            $table->foreign('home_physiotherapy_program_id')->references('id')->on('home_physiotherapy_programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('decision_hpp', function ($table) {
            $table->dropForeign(['decision_id']);
            $table->dropForeign(['home_physiotherapy_program_id']);
        });
        Schema::dropIfExists('decision_hpp');
    }
}
