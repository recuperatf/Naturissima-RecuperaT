<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageProgramRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hpp_massage', function (Blueprint $table) {
            $table->unsignedBigInteger('massage_id');
            $table->unsignedBigInteger('home_physiotherapy_program_id');
            $table->foreign('massage_id')->references('id')->on('massages');
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
        Schema::table('hpp_massage', function (Blueprint $table) {
            $table->dropForeign(['massage_id']);
            $table->dropForeign(['home_physiotherapy_program_id']);
        });
        Schema::dropIfExists('massage_program_relationship');
    }
}
