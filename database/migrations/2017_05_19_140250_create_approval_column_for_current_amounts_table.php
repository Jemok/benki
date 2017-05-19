<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalColumnForCurrentAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('current_accounts', function (Blueprint $table) {
            $table->integer('approval')->defaul(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('current_accounts', function (Blueprint $table) {
            $table->dropColumn('approval');
        });
    }
}
