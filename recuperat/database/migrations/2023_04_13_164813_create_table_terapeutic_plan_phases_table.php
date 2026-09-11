<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTerapeuticPlanPhasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('terapeutic_plan_phases');
        Schema::create('terapeutic_plan_phases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('objetives')->nullable();
            $table->text('restrictions')->nullable();
            $table->text('alarm_signs')->nullable();
            $table->text('inmovilization')->nullable();
            $table->text('pain_control')->nullable();
            $table->text('mobility')->nullable();
            $table->text('physical_agents')->nullable();
            $table->text('exercises')->nullable();
            $table->text('external_links')->nullable();
            $table->text('functional_activities')->nullable();
            $table->unsignedBigInteger('terapeutic_plan_id');
            $table->timestamps();

            $table->foreign('terapeutic_plan_id')->references('id')->on('terapeutic_plans');
        });
        Schema::create('terapeutic_plan_phases_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->unsignedBigInteger('terapeutic_plan_phase_id');
            $table->timestamps();

            $table->foreign('terapeutic_plan_phase_id')->references('id')->on('terapeutic_plan_phases');
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
            $table->dropForeign(['terapeutic_plan_id']);
            $table->dropColumn('terapeutic_plan_id');
        });
        Schema::table('terapeutic_plan_phases_images', function (Blueprint $table) {
            $table->dropForeign(['terapeutic_plan_phase_id']);
            $table->dropColumn('terapeutic_plan_phase_id');
        });
        Schema::dropIfExists('terapeutic_plan_phases_images');
    }
}

