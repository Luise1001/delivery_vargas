<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commerce_id');
            $table->char('document_type', 1);
            $table->string('document');
            $table->unsignedBigInteger('bank_id');
            $table->string('account_number');
            $table->timestamps();
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->foreign('bank_id')->references('id')->on('banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_payments');
    }
}
