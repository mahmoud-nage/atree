<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVariationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('variations', function (Blueprint $table) {
            $table->dropColumn('barcode');
            $table->dropColumn('title');
            $table->dropColumn('price');
            $table->dropColumn('type');
            $table->dropColumn('image');
            $table->dropColumn('parent_id');
            $table->dropColumn('order');
            $table->dropColumn('color');
            $table->integer('color_id');
            $table->integer('size_id');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variations', function (Blueprint $table) {
            //
        });
    }
}
