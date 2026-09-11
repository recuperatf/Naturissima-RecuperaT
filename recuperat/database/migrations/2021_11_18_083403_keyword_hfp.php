<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KeywordHfp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //keyword_hfp
        Schema::create('keyword_hfp', function (Blueprint $table) {
            $table->unsignedBigInteger('home_physiotherapy_program_id');
            $table->unsignedBigInteger('keyword_id');

            $table->foreign("home_physiotherapy_program_id")->references("id")->on("home_physiotherapy_programs");
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
        Schema::table('keyword_hfp', function (Blueprint $table) {
            $table->dropForeign(['home_physiotherapy_program_id']);
            $table->dropForeign(['keyword_id']);
        });
        Schema::dropIfExists('keyword_hfp');
    }
}
