<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPagesVersionMadeRevised extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_fisioterapias', function($table){
            $table->string('pages')->nullable();
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
        Schema::table('protocolo_fisioterapias', function($table){
            $table->dropColumn('pages')->nullable();
            $table->dropColumn('version')->nullable();
            $table->dropColumn('revised_by')->nullable();
            $table->dropColumn('made_by')->nullable();
        });
    }
}
