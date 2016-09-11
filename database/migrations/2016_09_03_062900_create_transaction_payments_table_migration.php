<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionPaymentsTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->increments('id');
            /**
             * The type of charge for this payment
             */
            $table->integer('transaction_charge_id')->unsigned();
            /**
             * The Chama or User who owns this payment
             */
            $table->integer('owner_id')->index()->unsigned();

            /**
             * The type of transaction Either: 1 for transfer or 2 for withdraw
             */
            $table->integer('transaction_type')->unsigned();

            /**
             * Either the transfer id or the withdraw id for this payment
             */
            $table->integer('transaction_id')->index()->unsigned();
            /**
             * The amount that was charged for this payment
             */
            $table->decimal('payment', 15, 2)->unsigned();

            /**
             * The relationship between a transaction payment
             * and the transaction charge it belongs to
             */
            $table->foreign('transaction_charge_id')
                  ->references('id')
                  ->on('transaction_charges');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction_payments');
    }
}
