<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsVersionsCodeAuthorsDiagnosisPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnosis_plans', function (Blueprint $table) {
            $table->string('version')->nullable();
            $table->string('code')->nullable();
            $table->string('pages')->nullable();
            $table->string('made_by')->nullable();
            $table->string('revised_by')->nullable();
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
            $table->dropColumn('version');
            $table->dropColumn('code');
            $table->dropColumn('pages');
            $table->dropColumn('made_by');
            $table->dropColumn('revised_by');
        });
    }
}
