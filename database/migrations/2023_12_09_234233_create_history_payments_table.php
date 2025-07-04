<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('commerce_id');
            $table->unsignedBigInteger('payment_option_id');
            $table->string('amount');
            $table->unsignedBigInteger('currency_id');
            $table->string('reference')->nullable();
            $table->unsignedBigInteger('express_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->boolean('verified')->default(false);
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->foreign('payment_option_id')->references('id')->on('payment_options');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('verified_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_payments');
    }
}
