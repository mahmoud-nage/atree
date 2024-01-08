<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name')->change()->nullable();
            $table->dropColumn('google_id');
            $table->dropColumn('facebook_id');
            $table->dropColumn('notes');
            $table->dropColumn('orders_count');
            $table->dropColumn('returns_count');
            $table->dropColumn('challenges_count');
            $table->dropColumn('finished_challenges_count');
            $table->dropColumn('unfinished_challenges_count');
            $table->dropColumn('points_count');
            $table->dropColumn('transferred_points');
            $table->dropColumn('total_purchases');
            $table->dropColumn('total_incomes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
