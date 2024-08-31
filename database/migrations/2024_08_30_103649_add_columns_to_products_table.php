<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('mobile_back_image', 191)->nullable();
            $table->string('mobile_back_tint', 191)->nullable();
            $table->string('mobile_back_shadow', 191)->nullable();
            $table->string('mobile_front_image', 191)->nullable();
            $table->string('mobile_front_tint', 191)->nullable();
            $table->string('mobile_front_shadow', 191)->nullable();
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
            $table->dropColumn('mobile_back_image', 'mobile_back_tint', 'mobile_back_shadow',
                'mobile_front_image', 'mobile_front_tint', 'mobile_front_shadow');
        });
    }
}
