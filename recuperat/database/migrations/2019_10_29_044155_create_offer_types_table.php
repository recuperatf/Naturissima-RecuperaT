<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("human_name");
            $table->timestamps();
        });
        Schema::table("offers",function($table){
            $table->unsignedBigInteger("offer_type_id");

            $table->foreign("offer_type_id")->references("id")->on("offer_types");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table("offers",function($table){
        //     $table->dropForeign("offer_type_id");
        // });
        Schema::dropIfExists('offers');
        Schema::dropIfExists('offer_types');
    }
}
