<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unique();
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('commerce_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id')->nullable()->default(null);
            $table->double('amount');
            $table->boolean('paid')->default(false);
            $table->enum('status', 
            ['pending',
             'in_the_way',
             'delivered', 
             'cancelled'
             ])->default('pending');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('driver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
