<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KeywordProtocol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyword_protocol', function (Blueprint $table) {
            $table->unsignedBigInteger('protocolo_fisioterapia_id');
            $table->unsignedBigInteger('keyword_id');

            $table->foreign("protocolo_fisioterapia_id")->references("id")->on("protocolo_fisioterapias");
            $table->foreign("keyword_id")->references("id")->on("keywords");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keyword_protocol', function (Blueprint $table) {
            $table->dropForeign(['protocolo_fisioterapia_id']);
            $table->dropForeign(['keyword_id']);
        });
        Schema::dropIfExists('keyword_protocol');
    }
}
