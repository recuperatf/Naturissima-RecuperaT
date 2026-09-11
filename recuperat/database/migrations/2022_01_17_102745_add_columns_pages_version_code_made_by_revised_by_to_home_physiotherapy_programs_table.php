<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPagesVersionCodeMadeByRevisedByToHomePhysiotherapyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_physiotherapy_programs', function (Blueprint $table) {
            $table->string('pages')->nullable();
            $table->string('code')->nullable();
            $table->string('version')->nullable();
            $table->string('revised_by')->nullable();
            $table->string('made_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_physiotherapy_programs', function (Blueprint $table) {
            $table->dropColumn('pages');
            $table->string('code')->nullable();
            $table->dropColumn('version');
            $table->dropColumn('revised_by');
            $table->dropColumn('made_by');
        });
    }
}
