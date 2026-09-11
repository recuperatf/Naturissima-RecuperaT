<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgressionCriteriaColumnToTerapeuticPlanPhasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terapeutic_plan_phases', function (Blueprint $table) {
            $table->text('progression_criteria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('terapeutic_plan_phases', function (Blueprint $table) {
            $table->dropColumn('progression_criteria');
        });
    }
}
