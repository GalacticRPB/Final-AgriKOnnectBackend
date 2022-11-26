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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->integer('customerId');
            $table->integer('order_id');
            $table->string('order_name');
            $table->integer('order_price');
            $table->integer('order_qty');
            $table->integer('order_total');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('contactNo');
            $table->string('shippingaddress');
            $table->string('modeofpayment');
            $table->timestamps();
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
};
