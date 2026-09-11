<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLaboralTherapeuticPlanIdToImageResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_resources', function (Blueprint $table) {
            $table->unsignedBigInteger('laboral_therapeutic_plan_id')->nullable();
            $table->foreign('laboral_therapeutic_plan_id')->references('id')->on('laboral_therapeutic_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_resources', function (Blueprint $table) {
            $table->dropForeign(['laboral_therapeutic_plan_id']);
            $table->dropColumn('laboral_therapeutic_plan_id');
        });
    }
}
