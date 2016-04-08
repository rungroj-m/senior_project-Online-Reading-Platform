<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('donations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('book_id')->unsigned();
          $table->float('goal_amount');
          $table->boolean('active');
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('book_id')->references('id')->on('books');
      });

      Schema::create('pleadings', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('donation_id')->unsigned();
          $table->float('amount');
          $table->boolean('confirmed');
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('donation_id')->references('id')->on('donations');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('donation');
        Schema::drop('pleadings');
    }
}
