<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsBibliographyDiagnosisPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnosis_plans', function (Blueprint $table) {
            $table->text('bibliography')->nullable();
        });

        Schema::create('keyword_diagnosis_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('diagnosis_plan_id');
            $table->unsignedBigInteger('keyword_id');

            $table->foreign("diagnosis_plan_id")->references("id")->on("diagnosis_plans");
            $table->foreign("keyword_id")->references("id")->on("keywords");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diagnosis_plans', function (Blueprint $table) {
            $table->dropColumn('bibliography');
        });

        Schema::table('keyword_diagnosis_plan', function (Blueprint $table) {
            $table->dropForeign(['diagnosis_plan_id']);
            $table->dropForeign(['keyword_id']);
        });
        Schema::dropIfExists('keyword_diagnosis_plan');
    }
}
