<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            // $table->unsignedBigInteger("user_id")->nullable();

            $table->string("buyer_name");
            $table->boolean("delivery")->default(false);
            $table->boolean("store_pickup")->default(false);
            $table->string("telephone")->nullable();
            $table->string("token_id")->nullable();

            $table->unsignedBigInteger("product_id")->nullable();
            $table->text("json_report")->nullable();
            $table->dateTime("appoinment_date")->nullable();
            $table->string("appoinment_patient_name")->nullable();

            $table->string("postal_code_facturation")->nullable();
            $table->string("name_facturation")->nullable();
            $table->string("state_facturation")->nullable();
            $table->string("street_and_number_facturacion")->nullable();
            $table->string("municipality_facturation")->nullable();

            $table->string("postal_code_send_address")->nullable();
            $table->string("name_send_address")->nullable();
            $table->string("state_send_address")->nullable();
            $table->string("municipality_send_address")->nullable();
            $table->string("street_and_number_send_adress")->nullable();

            $table->string("card_email")->nullable();
            $table->string("card_telephone")->nullable();

            $table->unsignedBigInteger("municipality_id")->nullable();
            $table->unsignedBigInteger("state_id")->nullable();

            // $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("product_id")->references("id")->on("products");
            $table->foreign("municipality_id")->references("id")->on("municipalities");
            $table->foreign("state_id")->references("id")->on("states");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("orders",function(Blueprint $table){
            $table->dropForeign("orders_product_id_foreign");
        });
        Schema::dropIfExists('orders');
    }
}
