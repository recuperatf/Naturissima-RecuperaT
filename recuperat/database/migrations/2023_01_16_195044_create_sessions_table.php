<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sessions');
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('session_objective_id');
            $table->unsignedBigInteger('clinical_history_id');
            $table->text('number_of_session');
            $table->text('activities');
            $table->text('observations');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('user_text');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('session_objective_id')->references('id')->on('session_objectives');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('sessions');
    }
}
