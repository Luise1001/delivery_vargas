<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmountOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amount_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->double('amount');
            $table->double('full_amount');
            $table->double('tax');
            $table->unsignedBigInteger('payment_option_id');
            $table->boolean('paid')->default(false);
            $table->enum('status', [
                'created',
                'confirmed',
                'arrived',
                'pending',
                'prepared',
                'assigned',
                'accepted',
                'delivered',
                'on_the_way',
                'completed',
                'cancelled'
            ])->default('created');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('amount_orders');
    }
}
