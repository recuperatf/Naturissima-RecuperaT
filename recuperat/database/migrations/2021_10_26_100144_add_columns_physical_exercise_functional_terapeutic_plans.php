<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPhysicalExerciseFunctionalTerapeuticPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terapeutic_plans', function (Blueprint $table) {
            $table->text('functional_activities')->nullable();
            $table->text('exercise_modalities')->nullable();
            $table->text('physical_modalities')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('terapeutic_plans', function (Blueprint $table) {
            $table->dropColumn('functional_activities');
            $table->dropColumn('exercise_modalities');
            $table->dropColumn('physical_modalities');
        });
    }
}
