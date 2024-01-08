<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressColsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('governorate_id');
            $table->string('address');
            $table->string('city');
            $table->string('order_phone');
            $table->integer('address_id')->change()->nullable();
            $table->integer('coupon_id')->change()->nullable();
            $table->integer('shipping_statues_id')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('governorate_id');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('order_phone');
        });
    }
}
