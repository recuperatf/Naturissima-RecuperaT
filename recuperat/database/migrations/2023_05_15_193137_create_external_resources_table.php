<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('external_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('creator')->nullable();
            $table->string('date_issued')->nullable();
            $table->string('latest_version')->nullable();
            $table->string('doi')->nullable();
            $table->text('version_history')->nullable();
            $table->string('document_status')->nullable();
            $table->unsignedBigInteger('collection_type_id');
            $table->timestamps();

            $table->foreign('collection_type_id')->references('id')->on('collection_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('external_resources', function(Blueprint $table) {
            $table->dropForeign('external_resources_collection_type_id_foreign');
        });
        Schema::dropIfExists('external_resources');
        Schema::dropIfExists('collection_types');
    }
}
