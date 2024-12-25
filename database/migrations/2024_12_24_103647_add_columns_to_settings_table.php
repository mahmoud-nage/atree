<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->float('point_equal_money')->default(0.0);
            $table->float('minimam_money_can_be_withdrawal')->default(0.0);
            $table->integer('days_to_valid_marketer_money')->default(0);
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
            $table->dropColumn('point_equal_money','minimam_money_can_be_withdrawal','days_to_valid_marketer_money');
        });
    }
}
