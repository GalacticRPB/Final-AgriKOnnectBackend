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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('shippingaddress');
            $table->string('mobilephone');
            $table->string('paymentId')->nullable();
            $table->string('modeofpayment');
            $table->string('tracking_no');
            $table->tinyInteger('status')->default('0');
            $table->text('remark');
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
        Schema::dropIfExists('orders');
    }
};
