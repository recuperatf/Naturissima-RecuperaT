<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthIdToDecisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('decisions', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('decisions', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });
        Schema::table('decisions', function (Blueprint $table) {
            $table->dropColumn('author_id');
        });
    }
}
