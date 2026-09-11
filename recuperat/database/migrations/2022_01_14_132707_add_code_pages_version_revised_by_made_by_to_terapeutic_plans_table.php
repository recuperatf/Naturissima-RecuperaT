<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodePagesVersionRevisedByMadeByToTerapeuticPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terapeutic_plans', function (Blueprint $table) {
            $table->string('code')->nullable();
            $table->string('pages')->nullable();
            $table->string('version')->nullable();
            $table->string('revised_by')->nullable();
            $table->string('made_by')->nullable();
            $table->unsignedBigInteger('anato_physiology_glosary_item_id')->nullable();
            $table->boolean('is_sealed')->default(false);

            $table->foreign('anato_physiology_glosary_item_id', 'tplans_gi_id')->references('id')->on('keywords');
        });
        Schema::create('keyword_terapeutic_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('terapeutic_plan_id');
            $table->unsignedBigInteger('keyword_id');

            $table->foreign("terapeutic_plan_id")->references("id")->on("terapeutic_plans");
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
        Schema::table('terapeutic_plans', function (Blueprint $table) {
            $table->dropForeign('tplans_gi_id');
            $table->dropColumn('anato_physiology_glosary_item_id');
            $table->dropColumn('code');
            $table->dropColumn('pages');
            $table->dropColumn('version');
            $table->dropColumn('revised_by');
            $table->dropColumn('made_by');
            $table->dropColumn('is_sealed');
        });

        Schema::table('keyword_terapeutic_plan', function (Blueprint $table) {
            $table->dropForeign(["terapeutic_plan_id"]);
            $table->dropForeign(["keyword_id"]);
        });

        Schema::dropIfExists('keyword_terapeutic_plan');
    }
}