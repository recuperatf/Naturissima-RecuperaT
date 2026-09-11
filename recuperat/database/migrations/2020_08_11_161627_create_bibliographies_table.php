<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBibliographiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bibliographies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('drive_info')->nullable();
            $table->datetime('date')->nullable();
            $table->string('format')->nullable();
            $table->string('identifier')->nullable();
            $table->string('language')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('coverage')->nullable();
            $table->string('relation')->nullable();
            $table->string('source')->nullable();
            $table->string('subject')->nullable();
            $table->string('type')->nullable();
            $table->string('contributor')->nullable();
            $table->string('creator')->nullable();
            $table->string('publisher')->nullable();
            $table->string('rights')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bibliographies', function($table){
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('bibliographies');
    }
}
