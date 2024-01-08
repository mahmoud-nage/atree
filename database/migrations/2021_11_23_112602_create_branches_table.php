<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('commercial_registration')->nullable();
            $table->tinyInteger('show_address')->default(0);
            $table->tinyInteger('show_phone1')->default(0);
            $table->tinyInteger('show_phone2')->default(0);
            $table->tinyInteger('show_mobile')->default(0);
            $table->tinyInteger('show_fax')->default(0);
            $table->tinyInteger('show_commercial_registration')->default(0);
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
        Schema::dropIfExists('branches');
    }
}
