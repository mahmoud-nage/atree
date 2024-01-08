<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_designs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('image');
            $table->integer('views_count')->default(0);
            $table->integer('times_used_count')->default(0);
            $table->integer('diamonds_earnd')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_designs');
    }
}
