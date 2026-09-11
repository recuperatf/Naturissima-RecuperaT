<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cie10AddSantanderColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_cie10s', function($table){
            $table->text('definition')->nullable();
            $table->text('epidemiology')->nullable();
            $table->text('text_lesion_mecanism')->nullable();
            $table->text('text_symptoms')->nullable();
            $table->text('text_diagnosis')->nullable();
            $table->text('text_physical_treatments')->nullable();
            $table->text('text_excersice_treatments')->nullable();
            $table->text('text_functional_activites')->nullable();
            $table->text('text_home_plan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('definition');
        $table->dropColumn('epidemiology');
        $table->dropColumn('text_lesion_mecanism');
        $table->dropColumn('text_symptoms');
        $table->dropColumn('text_diagnosis');
        $table->dropColumn('text_physical_treatments');
        $table->dropColumn('text_excersice_treatments');
        $table->dropColumn('text_functional_activites');
        $table->dropColumn('text_home_plan');
    }
}
