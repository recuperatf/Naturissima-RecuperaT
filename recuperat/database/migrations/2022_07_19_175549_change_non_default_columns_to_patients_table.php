<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNonDefaultColumnsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['birth_state_id']);
            $table->unsignedBigInteger('birth_state_id')->nullable()->change();
            $table->foreign('birth_state_id')->references('id')->on('states');
            $table->dropForeign(['birth_municipality_id']);
            $table->unsignedBigInteger('birth_municipality_id')->nullable()->change();
            $table->foreign('birth_municipality_id')->references('id')->on('municipalities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
        });
    }
}
