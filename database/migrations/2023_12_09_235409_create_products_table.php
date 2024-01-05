<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->char('code', 10)->unique();
            $table->string('description');
            $table->string('brand')->nullable();
            $table->boolean('photo')->nullable();
            $table->double('price');
            $table->double('full_price');
            $table->boolean('tax')->default(false);
            $table->double('weight')->nullable();
            $table->boolean('disabled')->default(false);
            $table->unsignedBigInteger('commerce_id');
            $table->unsignedBigInteger('category_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
