<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionProgramRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hpp_prescription', function (Blueprint $table) {
            $table->unsignedBigInteger('prescription_id');
            $table->unsignedBigInteger('home_physiotherapy_program_id');
            $table->text('indication')->nullable();
            $table->text('precautions')->nullable();
            $table->foreign('prescription_id')->references('id')->on('prescriptions');
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
        Schema::table('hpp_prescription', function (Blueprint $table) {
            $table->dropForeign(['prescription_id']);
            $table->dropForeign(['home_physiotherapy_program_id']);
        });
        Schema::dropIfExists('hpp_prescription');
    }
}
