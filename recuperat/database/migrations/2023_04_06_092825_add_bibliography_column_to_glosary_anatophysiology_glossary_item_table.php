<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBibliographyColumnToGlosaryAnatophysiologyGlossaryItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anato_physiology_glosary_items', function (Blueprint $table) {
            $table->text('bibliography')->nullable();
        });
        Schema::table('keywords', function (Blueprint $table) {
            $table->text('bibliography')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anato_physiology_glosary_items', function (Blueprint $table) {
            $table->dropColumn('bibliography');
        });
        Schema::table('keywords', function (Blueprint $table) {
            $table->dropColumn('bibliography');
        });
    }
}
