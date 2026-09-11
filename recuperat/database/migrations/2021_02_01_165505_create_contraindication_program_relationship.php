<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContraindicationProgramRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contraindication_hpp', function (Blueprint $table) {
            $table->unsignedBigInteger('contraindication_id');
            $table->unsignedBigInteger('home_physiotherapy_program_id');
            $table->foreign('contraindication_id')->references('id')->on('contraindications');
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
        Schema::table('contraindication_hpp', function (Blueprint $table) {
            $table->dropForeign(['contraindication_id']);
            $table->dropForeign(['home_physiotherapy_program_id']);
        });
        Schema::dropIfExists('hpp_prescription');
    }
}
