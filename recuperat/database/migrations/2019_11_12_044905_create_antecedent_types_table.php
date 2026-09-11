<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntecedentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedent_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->timestamps();
        });
        Schema::table('antecedents',function(Blueprint $table){
            $table->unsignedBigInteger('antecedent_type_id');

            $table->foreign('antecedent_type_id')->references('id')->on('antecedent_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('antecedents',function(Blueprint $table){
            $table->dropForeign(['antecedent_type_id']);
            $table->dropColumn('antecedent_type_id');
        });
        Schema::dropIfExists('antecedent_types');
    }
}
