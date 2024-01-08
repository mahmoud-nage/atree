<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('returnable_days');
            $table->dropColumn('minimam_withdrwals_earnings');
            $table->dropColumn('site_name');
            $table->dropColumn('point_equal_money');
            $table->dropColumn('points_money');
            $table->dropColumn('days_to_valid_marketer_money');
            $table->dropColumn('minimam_points_can_be_withdrawald');
            $table->dropColumn('minimam_money_can_be_withdrawald');
            $table->dropColumn('youtube');
            $table->longText('about_us');
            $table->text('logo');
            $table->text('android_link');
            $table->text('ios_link');
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
            //
        });
    }
}
