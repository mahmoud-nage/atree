<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->double('points_money');
            $table->integer('days_to_valid_marketer_money');
            $table->integer('minimam_points_can_be_withdrawald');
            $table->integer('minimam_money_can_be_withdrawald');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('points_money');
            $table->dropColumn('days_to_valid_marketer_money');
            $table->dropColumn('minimam_points_can_be_withdrawald');
            $table->dropColumn('minimam_money_can_be_withdrawald');
        });
    }
}
