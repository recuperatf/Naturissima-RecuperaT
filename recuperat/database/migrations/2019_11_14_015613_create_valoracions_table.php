<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valorations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('present')->nullable();
            $table->string('json_values');
            $table->string('section')->nullable();

            $table->unsignedBigInteger('cie10_id')->nullable();
            $table->foreign('cie10_id')->references('id')->on('cat_cie10s');
            $table->unsignedBigInteger('clinical_history_id');
            $table->foreign('clinical_history_id')->references('id')->on('clinical_histories');
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

        Schema::table('valorations',function($table){
            $table->dropForeign(['clinical_history_id']);
            $table->dropForeign(['cie10_id']);
        });
        Schema::dropIfExists('valorations');
    }
}
