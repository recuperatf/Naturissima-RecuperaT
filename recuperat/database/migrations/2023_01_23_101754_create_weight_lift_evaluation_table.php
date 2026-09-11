<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightLiftEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('weight_lift_evaluations');
        \DB::statement('CREATE TABLE weight_lift_evaluations (weight_lifting_1_mod_lift SMALLINT, weight_lifting_1_mod_transport SMALLINT, weight_lifting_1_mod_equipment SMALLINT, weight_lifting_2_mod_lift SMALLINT, weight_lifting_2_mod_transport SMALLINT, weight_lifting_2_mod_equipment SMALLINT, weight_lifting_3_mod_lift SMALLINT, weight_lifting_3_mod_transport SMALLINT, weight_lifting_3_mod_equipment SMALLINT, weight_lifting_4_mod_lift SMALLINT, weight_lifting_4_mod_transport SMALLINT, weight_lifting_4_mod_equipment SMALLINT, weight_lifting_5_mod_lift SMALLINT, weight_lifting_5_mod_transport SMALLINT, weight_lifting_5_mod_equipment SMALLINT, weight_lifting_6_mod_lift SMALLINT, weight_lifting_6_mod_transport SMALLINT, weight_lifting_6_mod_equipment SMALLINT, weight_lifting_7_mod_lift SMALLINT, weight_lifting_7_mod_transport SMALLINT, weight_lifting_7_mod_equipment SMALLINT, weight_lifting_8_mod_lift SMALLINT, weight_lifting_8_mod_transport SMALLINT, weight_lifting_8_mod_equipment SMALLINT, weight_lifting_9_mod_lift SMALLINT, weight_lifting_9_mod_transport SMALLINT, weight_lifting_9_mod_equipment SMALLINT, weight_lifting_10_mod_lift SMALLINT, weight_lifting_10_mod_transport SMALLINT, weight_lifting_10_mod_equipment SMALLINT, weight_lifting_11_mod_lift SMALLINT, weight_lifting_11_mod_transport SMALLINT, weight_lifting_11_mod_equipment SMALLINT, weight_lifting_12_mod_lift SMALLINT, weight_lifting_12_mod_transport SMALLINT, weight_lifting_12_mod_equipment SMALLINT, weight_lifting_13_mod_lift SMALLINT, weight_lifting_13_mod_transport SMALLINT, weight_lifting_13_mod_equipment SMALLINT, weight_lifting_14_mod_lift SMALLINT, weight_lifting_14_mod_transport SMALLINT, weight_lifting_14_mod_equipment SMALLINT, weight_lifting_15_mod_lift SMALLINT, weight_lifting_15_mod_transport SMALLINT, weight_lifting_15_mod_equipment SMALLINT, weight_lifting_16_mod_lift SMALLINT, weight_lifting_16_mod_transport SMALLINT, weight_lifting_16_mod_equipment SMALLINT, weight_lifting_17_mod_lift SMALLINT, weight_lifting_17_mod_transport SMALLINT, weight_lifting_17_mod_equipment SMALLINT, weight_lifting_18_mod_lift SMALLINT, weight_lifting_18_mod_transport SMALLINT, weight_lifting_18_mod_equipment SMALLINT, weight_lifting_19_mod_lift SMALLINT, weight_lifting_19_mod_transport SMALLINT, weight_lifting_19_mod_equipment SMALLINT, weight_lifting_20_mod_lift SMALLINT, weight_lifting_20_mod_transport SMALLINT, weight_lifting_20_mod_equipment SMALLINT, weight_lifting_21_mod_lift SMALLINT, weight_lifting_21_mod_transport SMALLINT, weight_lifting_21_mod_equipment SMALLINT, weight_lifting_22_mod_lift SMALLINT, weight_lifting_22_mod_transport SMALLINT, weight_lifting_22_mod_equipment SMALLINT, weight_lifting_23_mod_lift SMALLINT, weight_lifting_23_mod_transport SMALLINT, weight_lifting_23_mod_equipment SMALLINT, weight_lifting_24_mod_lift SMALLINT, weight_lifting_24_mod_transport SMALLINT, weight_lifting_24_mod_equipment SMALLINT, weight_lifting_25_mod_lift SMALLINT, weight_lifting_25_mod_transport SMALLINT, weight_lifting_25_mod_equipment SMALLINT, weight_lifting_26_mod_lift SMALLINT, weight_lifting_26_mod_transport SMALLINT, weight_lifting_26_mod_equipment SMALLINT, equipment_1_mod_rolling SMALLINT, equipment_1_mod_turning SMALLINT, equipment_1_mod_dragging SMALLINT, equipment_2_mod_rolling SMALLINT, equipment_2_mod_turning SMALLINT, equipment_2_mod_dragging SMALLINT, equipment_3_mod_rolling SMALLINT, equipment_3_mod_turning SMALLINT, equipment_3_mod_dragging SMALLINT, equipment_4_mod_rolling SMALLINT, equipment_4_mod_turning SMALLINT, equipment_4_mod_dragging SMALLINT, equipment_5_mod_rolling SMALLINT, equipment_5_mod_turning SMALLINT, equipment_5_mod_dragging SMALLINT, equipment_6_mod_rolling SMALLINT, equipment_6_mod_turning SMALLINT, equipment_6_mod_dragging SMALLINT, equipment_7_mod_rolling SMALLINT, equipment_7_mod_turning SMALLINT, equipment_7_mod_dragging SMALLINT, equipment_8_mod_rolling SMALLINT, equipment_8_mod_turning SMALLINT, equipment_8_mod_dragging SMALLINT, equipment_9_mod_rolling SMALLINT, equipment_9_mod_turning SMALLINT, equipment_9_mod_dragging SMALLINT, push_drag_1_mod_rolling SMALLINT, push_drag_1_mod_turning SMALLINT, push_drag_1_mod_dragging SMALLINT, push_drag_2_mod_rolling SMALLINT, push_drag_2_mod_turning SMALLINT, push_drag_2_mod_dragging SMALLINT, push_drag_3_mod_rolling SMALLINT, push_drag_3_mod_turning SMALLINT, push_drag_3_mod_dragging SMALLINT, push_drag_4_mod_rolling SMALLINT, push_drag_4_mod_turning SMALLINT, push_drag_4_mod_dragging SMALLINT, push_drag_5_mod_rolling SMALLINT, push_drag_5_mod_turning SMALLINT, push_drag_5_mod_dragging SMALLINT, push_drag_6_mod_rolling SMALLINT, push_drag_6_mod_turning SMALLINT, push_drag_6_mod_dragging SMALLINT, push_drag_7_mod_rolling SMALLINT, push_drag_7_mod_turning SMALLINT, push_drag_7_mod_dragging SMALLINT, push_drag_8_mod_rolling SMALLINT, push_drag_8_mod_turning SMALLINT, push_drag_8_mod_dragging SMALLINT)');
        Schema::table('weight_lift_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clinical_history_id');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('clinical_history_id')->references('id')->on('clinical_histories');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_lift_evaluations');
    }
}
