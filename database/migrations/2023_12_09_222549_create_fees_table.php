<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->double('from');
            $table->double('to');
            $table->unsignedBigInteger('service_id');
            $table->double('price');
            $table->boolean('special')->default(false);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
}
