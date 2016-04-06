<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('parentKey');
            $table->integer('book_id');
            $table->text('review');
            $table->integer('rating')->default(0);
            $table->timestamps();
        });

        Schema::create('reviewRatings', function (Blueprint $table){
            $table->increments('id');
            $table->integer('review_id');
            $table->integer('user_id');
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
        Schema::drop('books_reviews');
        Schema::drop('reviewRatings');
    }
}
