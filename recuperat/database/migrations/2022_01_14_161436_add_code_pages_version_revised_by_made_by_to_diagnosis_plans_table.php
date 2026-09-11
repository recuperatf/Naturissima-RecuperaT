<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodePagesVersionRevisedByMadeByToDiagnosisPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnosis_plans', function (Blueprint $table) {
            $table->boolean('is_sealed')->default(false);
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
            $table->dropColumn('is_sealed');
        });
    }
}