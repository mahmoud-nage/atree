<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreAndMoreColsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('sub_category_id')->nullable();
            $table->integer('sub_sub_category_id')->nullable();
            $table->integer('type')->nullable();
            $table->integer('minimam')->nullable();
            $table->tinyInteger('includes_tax');
            $table->tinyInteger('policy_segmental')->default(1)->comment('2ta3i');
            $table->tinyInteger('wholesale_policy')->default(0)->comment('gomlah');
            $table->tinyInteger('have_wholesale_policy')->default(0)->comment('nos gomlah');
            $table->tinyInteger('vip_policy')->default(0)->comment('vip');
            $table->string('barcode')->nullable();
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
            $table->dropColumn('sub_category_id');
            $table->dropColumn('sub_sub_category_id');
            $table->dropColumn('type');
            $table->dropColumn('minimam');
            $table->dropColumn('includes_tax');
            $table->dropColumn('policy_segmental');
            $table->dropColumn('wholesale_policy');
            $table->dropColumn('have_wholesale_policy');
            $table->dropColumn('vip_policy');
            $table->dropColumn('barcode');
        });
    }
}
