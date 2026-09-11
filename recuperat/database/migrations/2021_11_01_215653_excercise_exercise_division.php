<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExcerciseExerciseDivision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('excercise_exercise_divisions', function (Blueprint $table) {
        //     $table->unsignedBigInteger('exercise_id')->nullable();
        //     $table->unsignedBigInteger('exercise_division_id')->nullable();

        //     $table->foreign('exercise_id')->references('id')->on('exercises');
        //     $table->foreign('exercise_division_id')->references('id')->on('excercise_divisions');
        // });
        Schema::table('exercises', function (Blueprint $table) {
            $table->unsignedBigInteger('exercise_division_id')->nullable();

            $table->foreign('exercise_division_id')->references('id')->on('excercise_divisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('excercise_exercise_divisions', function (Blueprint $table) {
        //     $table->dropForeign(['exercise_id']);
        //     $table->dropForeign(['exercise_division_id']);
        // });
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropForeign(['exercise_division_id']);
            $table->dropColumn('exercise_division_id');
        });
    }
}
