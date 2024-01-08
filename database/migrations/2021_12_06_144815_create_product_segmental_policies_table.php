<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSegmentalPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_segmental_policies', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('branch_id');
            $table->integer('unit_id');
            $table->double('price');
            $table->double('percentage');
            $table->double('discount');
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
        Schema::dropIfExists('product_segmental_policies');
    }
}
