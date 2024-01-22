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
            $table->string('site_back_width', 191)->nullable();
            $table->string('site_back_height', 191)->nullable();
            $table->string('site_back_left', 191)->nullable();
            $table->string('site_back_top', 191)->nullable();
            $table->string('site_front_width', 191)->nullable();
            $table->string('site_front_height', 191)->nullable();
            $table->string('site_front_left', 191)->nullable();
            $table->string('site_front_top', 191)->nullable();
            $table->string('mobile_back_image_width', 191)->nullable();
            $table->string('mobile_back_image_height', 191)->nullable();
            $table->string('mobile_back_width', 191)->nullable();
            $table->string('mobile_back_height', 191)->nullable();
            $table->string('mobile_back_left', 191)->nullable();
            $table->string('mobile_back_top', 191)->nullable();
            $table->string('mobile_front_image_width', 191)->nullable();
            $table->string('mobile_front_image_height', 191)->nullable();
            $table->string('mobile_front_width', 191)->nullable();
            $table->string('mobile_front_height', 191)->nullable();
            $table->string('mobile_front_left', 191)->nullable();
            $table->string('mobile_front_top', 191)->nullable();
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
            $table->dropColumn(
                'site_back_width',
                'site_back_height',
                'site_back_left',
                'site_back_top',
                'site_front_width',
                'site_front_height',
                'site_front_left',
                'site_front_top',
                'mobile_back_image_width',
                'mobile_back_image_height',
                'mobile_back_width',
                'mobile_back_height',
                'mobile_back_left',
                'mobile_back_top',
                'mobile_front_image_width',
                'mobile_front_image_height',
                'mobile_front_width',
                'mobile_front_height',
                'mobile_front_left',
                'mobile_front_top',
            );
        });
    }
}
