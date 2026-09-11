<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomePlansCie10 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_cie10_home_plans', function ($table) {
            $table->unsignedBigInteger('cat_cie10_id');
            $table->unsignedBigInteger('home_plan_id');

            $table->foreign('cat_cie10_id')->references('id')->on('cat_cie10s');
            $table->foreign('home_plan_id')->references('id')->on('home_physiotherapy_programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_cie10_home_plans', function ($table) {
            $table->dropForeign(['cat_cie10_id']);
            $table->dropForeign(['home_plan_id']);
        });
        Schema::drop('cat_cie10_home_plans');
    }
}
