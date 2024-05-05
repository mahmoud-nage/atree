<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDesignImageToUserDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_designs', function (Blueprint $table) {
            $table->text('design_image_front')->nullable();
            $table->text('design_image_back')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_designs', function (Blueprint $table) {
            $table->dropColumn('design_image_front', 'design_image_back');
        });
    }
}
