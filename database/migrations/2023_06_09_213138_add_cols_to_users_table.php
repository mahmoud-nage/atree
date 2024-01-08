<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('orders_count')->default(0);
            $table->integer('returns_count')->default(0);
            $table->integer('challenges_count')->default(0);
            $table->integer('finished_challenges_count')->default(0);
            $table->integer('unfinished_challenges_count')->default(0);
            $table->integer('points_count')->default(0);
            $table->integer('transferred_points')->default(0);
            $table->float('total_purchases')->default(0);
            $table->float('total_incomes')->default(0);
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
}
