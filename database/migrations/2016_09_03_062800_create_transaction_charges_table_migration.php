<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionChargesTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_charges', function (Blueprint $table) {
            $table->increments('id');
            /**
             * The type of transaction that the charge is for
             */
            $table->integer('transaction_type')->unsigned();

            /**
             * The category of the transaction charge
             */
            $table->integer('transaction_category')->unsigned();
            /**
             * The user who created the transaction charge
             */

            /**
             * The transaction name
             */

            $table->string('transaction_name');

            $table->integer('user_id')->index()->unsigned();
            /**
             * The amount to charge
             */
            $table->decimal('charge', 15, 2)->unsigned();

            /**
             * The relationship definition between
             * this table and the users table
             */
            $table->foreign('user_id')
                   ->references('id')
                   ->on('users');

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
        Schema::drop('transaction_charges');
    }
}
