<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZellePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zelle_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commerce_id');
            $table->string('email');
            $table->string('owner_name');
            $table->timestamps();
            $table->foreign('commerce_id')->references('id')->on('commerces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zelle_payments');
    }
}
