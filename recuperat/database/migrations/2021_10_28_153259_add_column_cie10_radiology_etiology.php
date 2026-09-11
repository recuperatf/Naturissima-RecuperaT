<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCie10RadiologyEtiology extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_cie10s', function ($table) {
            $table->text('etiology')->nullable();
            $table->text('text_radiologic_diagnosis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_cie10s', function ($table) {
            $table->dropColumn('etiology');
            $table->dropColumn('text_radiologic_diagnosis');
        });
    }
}
