<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDollarRatesMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dollar_rates', function (Blueprint $table) {
            $table->increments('id');

            /**
             * The user_id key
             */
            $table->integer('user_id')->index()->unsigned();

            $table->decimal('rate');

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
        Schema::drop('dollar_rates');
    }
}
