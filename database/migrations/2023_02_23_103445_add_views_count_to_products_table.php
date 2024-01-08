<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsCountToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('views_count')->default(0);
            $table->integer('return_count')->default(0);
            $table->integer('minimam_stock_alert')->default(0);
            $table->integer('country_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('views_count');
            $table->dropColumn('return_count');
            $table->dropColumn('minimam_stock_alert');
            $table->dropColumn('country_id');
        });
    }
}
