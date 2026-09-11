<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnatoPhysioProtocolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('protocolo_fisioterapias', function($table) {
        //     $table->unsignedBigInteger('anato_physiology_glosary_item_id')->nullable();

        //     $table->foreign('anato_physiology_glosary_item_id')->references('id')->on('anato_physiology_glosary_items');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('protocolo_fisioterapias', function($table) {
        //     $table->dropForeign(['anato_physiology_glosary_item_id']);
        //     $table->dropColumn('anato_physiology_glosary_item_id');
        // });
    }
}
