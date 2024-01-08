<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->double('price');
            $table->text('image')->nullable();
            $table->string('name');
            $table->text('mini_description')->nullable();
            $table->longText('description')->nullable();
            $table->integer('rate')->nullable();
            $table->string('world_code');
            $table->string('local_code');
            $table->integer('unit_id');
            $table->tinyInteger('returnable')->default(1)->comment('1 yes 0 no');
            $table->integer('carton_includes');
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
        Schema::dropIfExists('products');
    }
}
