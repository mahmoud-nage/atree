<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->tinyInteger('is_active');
            $table->integer('orders');
            $table->integer('money');
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();
            $table->integer('user_id');
            $table->tinyInteger('should_user_finishes_to_receive_money');
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
        Schema::dropIfExists('challenges');
    }
}
