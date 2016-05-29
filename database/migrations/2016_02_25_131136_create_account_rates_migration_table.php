<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountRatesMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_one')->unsigned();
            $table->integer('category_two')->unsigned();
            $table->integer('category_three')->unsigned();
            $table->integer('category_four')->unsigned();
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
        Schema::drop('account_rates');
    }
}
