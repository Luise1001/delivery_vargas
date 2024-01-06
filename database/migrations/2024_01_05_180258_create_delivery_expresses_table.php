<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_expresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('route_id');
            $table->boolean('personal')->default(false);
            $table->boolean('comercial')->default(false);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->unsignedBigInteger('commerce_id')->nullable()->default(null);
            $table->double('amount');
            $table->boolean('paid')->default(false);
            $table->enum('status', 
            ['pending',
             'in_the_way',
             'delivered', 
             'cancelled'
             ])->default('pending');
             $table->string('comment')->nullable()->default(null);
            $table->unsignedBigInteger('driver_id')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->foreign('driver_id')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_expresses');
    }
};
