<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalAgentsProgramRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hpp_physical_agent', function (Blueprint $table) {
            $table->unsignedBigInteger('physical_agent_id');
            $table->unsignedBigInteger('home_physiotherapy_program_id');
            $table->text('indication')->nullable();
            $table->text('precautions')->nullable();
            $table->foreign('physical_agent_id')->references('id')->on('physical_agents');
            $table->foreign('home_physiotherapy_program_id')->references('id')->on('home_physiotherapy_programs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hpp_physical_agent', function (Blueprint $table) {
            $table->dropForeign(['physical_agent_id']);
            $table->dropForeign(['home_physiotherapy_program_id']);
        });
        Schema::dropIfExists('hpp_physical_agent');
    }
}
