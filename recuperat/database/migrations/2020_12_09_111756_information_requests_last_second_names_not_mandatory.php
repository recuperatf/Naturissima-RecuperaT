<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InformationRequestsLastSecondNamesNotMandatory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('information_requests', function (Blueprint $table) {
            $table->string('last_name')->nullable()->change();
            $table->string('second_last_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('information_requests', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('second_last_name');
        });
    }
}
