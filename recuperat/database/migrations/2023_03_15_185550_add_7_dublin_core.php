<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add7DublinCore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('protocolo_fisioterapias', function(Blueprint $table) {
            $table->text('creator')->nullable();
            $table->text('date_issued')->nullable();
            $table->text('latest_version')->nullable();
            $table->text('version_history')->nullable();
            $table->text('document_status')->nullable();
        });
        Schema::table('home_physiotherapy_programs', function(Blueprint $table) {
            $table->text('creator')->nullable();
            $table->text('date_issued')->nullable();
            $table->text('latest_version')->nullable();
            $table->text('version_history')->nullable();
            $table->text('document_status')->nullable();
        });
        Schema::table('diagnosis_plans', function(Blueprint $table) {
            $table->text('creator')->nullable();
            $table->text('date_issued')->nullable();
            $table->text('latest_version')->nullable();
            $table->text('version_history')->nullable();
            $table->text('document_status')->nullable();
        });
        Schema::table('terapeutic_plans', function(Blueprint $table) {
            $table->text('creator')->nullable();
            $table->text('date_issued')->nullable();
            $table->text('latest_version')->nullable();
            $table->text('version_history')->nullable();
            $table->text('document_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolo_fisioterapias', function(Blueprint $table) {
            $table->dropColumn('creator')->nullable();
            $table->dropColumn('date_issued')->nullable();
            $table->dropColumn('latest_version')->nullable();
            $table->dropColumn('version_history')->nullable();
            $table->dropColumn('document_status')->nullable();
        });
        Schema::table('home_physiotherapy_programs', function(Blueprint $table) {
            $table->dropColumn('creator')->nullable();
            $table->dropColumn('date_issued')->nullable();
            $table->dropColumn('latest_version')->nullable();
            $table->dropColumn('version_history')->nullable();
            $table->dropColumn('document_status')->nullable();
        });
        Schema::table('diagnosis_plans', function(Blueprint $table) {
            $table->dropColumn('creator')->nullable();
            $table->dropColumn('date_issued')->nullable();
            $table->dropColumn('latest_version')->nullable();
            $table->dropColumn('version_history')->nullable();
            $table->dropColumn('document_status')->nullable();
        });
        Schema::table('terapeutic_plans', function(Blueprint $table) {
            $table->dropColumn('creator')->nullable();
            $table->dropColumn('date_issued')->nullable();
            $table->dropColumn('latest_version')->nullable();
            $table->dropColumn('version_history')->nullable();
            $table->dropColumn('document_status')->nullable();
        });
    }
}
