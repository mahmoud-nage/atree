<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->integer('status')->change()->comment('1 done , 2 proccessing , 3 refused , ');
            $table->dropColumn('approve_comments');
            $table->dropColumn('refuse_comments');
            $table->dropColumn('approved_by');
            $table->dropColumn('refused_by');
            $table->dropColumn('file');
            $table->dropColumn('payment_method_id');
            $table->string('payment_method')->nullable();
            $table->text('system_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            //
        });
    }
}
