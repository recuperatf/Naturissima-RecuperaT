<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProtocoloAddSections57 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_fisioterapias', function (Blueprint $table) {
            $table->text('text_injury_mechanism');
            $table->text('text_symptoms')->nullable();
            $table->text('text_clinic_radiologic_diagnosis')->nullable();
            $table->text('text_physical_treatments')->nullable();
            $table->text('text_excersice_treatments')->nullable();
            $table->text('text_functional_activites')->nullable();
            $table->text('text_equipment_and_elements')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolo_fisioterapias', function (Blueprint $table) {
            $table->text('text_injury_mechanism');
            $table->text('text_symptoms')->nullable();
            $table->text('text_clinic_radiologic_diagnosis')->nullable();
            $table->text('text_physical_treatments')->nullable();
            $table->text('text_excersice_treatments')->nullable();
            $table->text('text_functional_activites')->nullable();
            $table->text('text_equipment_and_elements')->nullable();
        });
    }
}
