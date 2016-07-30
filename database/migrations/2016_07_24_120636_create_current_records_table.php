<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_records', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount')->unsigned();
            $table->integer('current_account_id')->index()->unsigned();
            $table->timestamps();

            //disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $table->foreign('current_account_id')
                  ->references('id')
                  ->on('current_accounts');

            //Supposed to only apply to a single connection and reset itself
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('current_records');
    }
}
