<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveExtraColFromProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('brand_id');
            $table->dropColumn('marketer_price');
            $table->dropColumn('price_after_discount');
            $table->dropColumn('discount_percentage');
            $table->dropColumn('points');
            $table->dropColumn('barcode');
            $table->dropColumn('minimam_gomla_number');
            $table->dropColumn('min_price');
            $table->dropColumn('return_count');
            $table->dropColumn('is_returnable');
            $table->dropColumn('max_price');
            $table->dropColumn('total_marketers_sales');
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
            $table->longText('description');
        });
    }
}
