<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDesignIdToModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('design_id');
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('design_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('design_id');
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('design_id');
        });
    }
}
