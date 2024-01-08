<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->integer('address_id');
            $table->integer('user_id');
            $table->integer('coupon_id')->nullable();
            $table->text('number');
            $table->double('total' , 8 , 2);
            $table->double('discount' , 8 , 2)->nullable();
            $table->double('subtotal' , 8 , 2);
            $table->double('shipping_cost' , 8 , 2)->nullable();
            $table->integer('shipping_statues_id');
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
}
