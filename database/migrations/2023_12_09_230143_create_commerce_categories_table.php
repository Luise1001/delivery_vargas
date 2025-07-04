<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommerceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commerce_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commerce_categories');
    }
}
