<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatCIE10STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_cie10s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->timestamps();
        });
        Schema::table('antecedents', function (Blueprint $table) {
            $table->unsignedBigInteger('cie10_id')->nullable();
            $table->foreign('cie10_id')->references('id')->on('cat_cie10s');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('antecedents', function (Blueprint $table) {
            $table->dropForeign(['cie10_id']);
        });
        Schema::dropIfExists('cat_cie10s');
    }
}
