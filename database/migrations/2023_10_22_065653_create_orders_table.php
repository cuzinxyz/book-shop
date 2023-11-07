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
            $table->string('fullname');
            $table->json('cart_orders');
            $table->string('phone_number', 20);
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('payment_method');
            $table->string('status_order')->default(0);
            $table->text('note_order')->nullable();
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
