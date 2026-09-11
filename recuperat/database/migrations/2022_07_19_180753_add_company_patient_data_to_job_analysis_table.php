<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyPatientDataToJobAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_analysis', function (Blueprint $table) {
            $table->string('department')->nullable();
            $table->string('work')->nullable();
            $table->string('asignation')->nullable();
            $table->string('equipment')->nullable();
            $table->text('work_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_analysis', function (Blueprint $table) {
            $table->dropColumn('department');
            $table->dropColumn('work');
            $table->dropColumn('asignation');
            $table->dropColumn('equipment');
            $table->dropColumn('work_description');
        });
    }
}
