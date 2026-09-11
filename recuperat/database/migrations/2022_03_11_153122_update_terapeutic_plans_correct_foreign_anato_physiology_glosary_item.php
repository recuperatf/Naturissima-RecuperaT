<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTerapeuticPlansCorrectForeignAnatoPhysiologyGlosaryItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terapeutic_plans', function ($table) {
            $table->dropForeign('tplans_gi_id');

            $table->foreign('anato_physiology_glosary_item_id', 'tplans_gi_id')->references('id')->on('anato_physiology_glosary_items');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
