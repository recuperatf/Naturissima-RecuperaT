<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignProtocolAnatoPhysiologyGlosaryItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_fisioterapias', function ($table) {
            $table->dropForeign(['anato_physiology_glosary_item_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolo_fisioterapias', function($table) {
            $table->foreign('anato_physiology_glosary_item_id')->references('id')->on('anato_physiology_glosary_items');
        });
    }
}
