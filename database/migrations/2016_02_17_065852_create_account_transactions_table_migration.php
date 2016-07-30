<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTransactionsTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_type');
            $table->integer('transaction_amount')->unsigned();
            $table->integer('percentage')->unsigned();
            $table->integer('duration')->unsigned();
            $table->integer('deduct_amount')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('transaction_status')->unsigned()->default(1);
            $table->integer('rate_pay_count')->unsigned();
            $table->dateTime('withdraw_date');
            $table->timestamps();

            $table->foreign('account_id')
                  ->references('id')->on('current_accounts')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('current_account_transactions');
    }
}
