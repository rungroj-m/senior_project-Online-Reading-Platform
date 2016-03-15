<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBridgedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('books_comments', function (Blueprint $table) {
            $table->dropColumn(['bookKey', 'commentKey']);
            $table->integer('book_id')->unsigned()->references('book_id')->on('books');
            $table->integer('comment_id')->unsigned()->references('comment_id')->on('comments');
        });


        Schema::table('books_contents', function (Blueprint $table) {
            $table->dropColumn(['bookKey', 'contentKey']);

            $table->integer('book_id')->unsigned()->references('book_id')->on('books');
            $table->integer('content_id')->unsinged()->references('content_id')->on('contents');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
