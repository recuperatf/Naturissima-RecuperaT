<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInitialEvaluationToTerapeuticPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terapeutic_plans', function (Blueprint $table) {
            $table->text('initial_evaluation')->nullable();
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
            $table->dropColumn('initial_evaluation');
        });
    }
}
