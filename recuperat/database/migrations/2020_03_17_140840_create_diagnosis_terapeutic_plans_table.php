<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosisTerapeuticPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        
        Schema::create('terapeutic_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('terapeutic_plan_protocolo', function($table){
            $table->unsignedBigInteger('protocolo_fisioterapia_id');
            $table->unsignedBigInteger('terapeutic_plan_id');

            $table->foreign('terapeutic_plan_id')->references('id')->on('terapeutic_plans');
            $table->foreign('protocolo_fisioterapia_id')->references('id')->on('protocolo_fisioterapias');
        });

        Schema::create('diagnosis_plan_protocolo', function($table){
            $table->unsignedBigInteger('protocolo_fisioterapia_id');
            $table->unsignedBigInteger('diagnosis_plan_id');

            $table->foreign('diagnosis_plan_id')->references('id')->on('diagnosis_plans');
            $table->foreign('protocolo_fisioterapia_id')->references('id')->on('protocolo_fisioterapias');
        });

        Schema::create('video_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('terapeutic_plan_id')->nullable();
            $table->unsignedBigInteger('diagnosis_plan_id')->nullable();
            $table->foreign('diagnosis_plan_id')->references('id')->on('diagnosis_plans')->onDelete('cascade');
            $table->foreign('terapeutic_plan_id')->references('id')->on('terapeutic_plans')->onDelete('cascade');
        });

        Schema::create('image_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('terapeutic_plan_id')->nullable();
            $table->unsignedBigInteger('diagnosis_plan_id')->nullable();
            $table->foreign('diagnosis_plan_id')->references('id')->on('diagnosis_plans')->onDelete('cascade');
            $table->foreign('terapeutic_plan_id')->references('id')->on('terapeutic_plans')->onDelete('cascade');
        });

        Schema::create('outside_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('terapeutic_plan_id')->nullable();
            $table->unsignedBigInteger('diagnosis_plan_id')->nullable();
            $table->foreign('diagnosis_plan_id')->references('id')->on('diagnosis_plans')->onDelete('cascade');
            $table->foreign('terapeutic_plan_id')->references('id')->on('terapeutic_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_resources', function (Blueprint $table) {
            $table->dropForeign(['diagnosis_plan_id']);
            $table->dropForeign(['terapeutic_plan_id']);
        });
        Schema::table('image_resources', function (Blueprint $table) {
            $table->dropForeign(['diagnosis_plan_id']);
            $table->dropForeign(['terapeutic_plan_id']);
        });
        Schema::table('outside_resources', function (Blueprint $table) {
            $table->dropForeign(['diagnosis_plan_id']);
            $table->dropForeign(['terapeutic_plan_id']);
        });

        Schema::table('terapeutic_plan_protocolo', function($table){
            $table->dropForeign(['terapeutic_plan_id']);
            $table->dropForeign(['protocolo_fisioterapia_id']);
        });

        Schema::table('diagnosis_plan_protocolo', function($table){
            $table->dropForeign(['diagnosis_plan_id']);
            $table->dropForeign(['protocolo_fisioterapia_id']);
        });

        Schema::dropIfExists('terapeutic_plans');
        Schema::dropIfExists('diagnosis_plans');
        Schema::dropIfExists('image_resources');
        Schema::dropIfExists('video_resources');
        Schema::dropIfExists('outside_resources');
        Schema::dropIfExists('terapeutic_plan_protocolo');
        Schema::dropIfExists('diagnosis_plan_protocolo');
    }
}
