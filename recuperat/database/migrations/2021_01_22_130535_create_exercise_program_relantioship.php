<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseProgramRelantioship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_hpp', function (Blueprint $table) {
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedBigInteger('home_physiotherapy_program_id');
            $table->string('series')->nullable();
            $table->string('repetitions')->nullable();
            $table->foreign('exercise_id')->references('id')->on('exercises');
            $table->foreign('home_physiotherapy_program_id')->references('id')->on('home_physiotherapy_programs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exercise_hpp', function (Blueprint $table) {
            $table->dropForeign(['exercise_id']);
            $table->dropForeign(['home_physiotherapy_program_id']);
        });
        Schema::dropIfExists('exercise_hpp');
    }
}
