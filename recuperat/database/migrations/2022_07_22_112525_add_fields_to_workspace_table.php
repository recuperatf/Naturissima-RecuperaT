<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToWorkspaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workspaces', function (Blueprint $table) {
            $table->string('department')->nullable();
            $table->string('work')->nullable();
            $table->string('asignation')->nullable();
            $table->string('equipment')->nullable();
            $table->text('job_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workspaces', function (Blueprint $table) {
            $table->dropColumn('department');
            $table->dropColumn('work');
            $table->dropColumn('asignation');
            $table->dropColumn('equipment');
            $table->dropColumn('job_description');
        });
    }
}
