<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commerce_id');
            $table->unsignedBigInteger('payment_option_id');
            $table->timestamps();
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->foreign('payment_option_id')->references('id')->on('payment_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commerce_payment_methods');
    }
}
