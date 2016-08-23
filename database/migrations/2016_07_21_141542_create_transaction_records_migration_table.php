<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionRecordsMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_transaction_id')->unsigned()->index();
            $table->decimal('amount')->unsigned();
            $table->timestamps();

            //disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $table->foreign('account_transaction_id')
                  ->references('id')
                  ->on('account_transactions');

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
        Schema::drop('transaction_records');
    }
}
