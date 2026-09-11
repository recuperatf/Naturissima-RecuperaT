<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySantanderToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_fisioterapias', function (Blueprint $table) {
            $table->text('abbreviations')->nullable()->change();
            $table->text('text_risk_factors')->nullable()->change();
            $table->text('text_lesions')->nullable()->change();
            $table->text('clinical_history')->nullable()->change();
            $table->text('text_revision_systems')->nullable()->change();
            $table->text('text_test_and_meassurements')->nullable()->change();
            $table->text('phisiotherapeutic_diagnosis')->nullable()->change();

            $table->text('objective')->nullable()->change();
            $table->text('reach')->nullable()->change();
            $table->text('inclusion_criteria_text')->nullable()->change();
            $table->text('prognosis')->nullable()->change();
            $table->text('clinical_diagnosis_explanation')->nullable()->change();
        });

        Schema::table('diagnosis_plans', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
