<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsBackToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->json('details_back')->nullable();
        });
        Schema::table('user_designs', function (Blueprint $table) {
            $table->json('details_back')->nullable();
        });
        Schema::table('carts', function (Blueprint $table) {
        $table->json('details_back')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('details_back');
        });
        Schema::table('user_designs', function (Blueprint $table) {
            $table->dropColumn('details_back');
        });
        Schema::table('carts', function (Blueprint $table) {
        $table->dropColumn('details_back');
    });
    }
}
