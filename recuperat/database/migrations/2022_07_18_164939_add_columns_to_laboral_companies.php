<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLaboralCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laboral_companies', function (Blueprint $table) {
            $table->string('social_reason')->nullable();
            $table->string('general_office_address')->nullable();
            $table->string('contact_office_address')->nullable();
            $table->string('email')->nullable();
            $table->string('webpage')->nullable();
            $table->string('schedule')->nullable();
            $table->string('marks')->nullable();
            $table->string('rfc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laboral_companies', function (Blueprint $table) {
            $table->dropColumn('social_reason');
            $table->dropColumn('general_office_address');
            $table->dropColumn('contact_office_address');
            $table->dropColumn('email');
            $table->dropColumn('webpage');
            $table->dropColumn('schedule');
            $table->dropColumn('marks');
            $table->dropColumn('rfc');
        });
    }
}
