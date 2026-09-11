<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_objectives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->unsignedBigInteger('clinical_history_id');
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
        Schema::table('session_objectives', function (Blueprint $table) {
            $table->dropForeign(['clinical_history_id']);
            $table->dropColumn(['clinical_history_id']);
        });
        Schema::dropIfExists('session_objectives');
    }
}
