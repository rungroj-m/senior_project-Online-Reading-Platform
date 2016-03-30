<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id')->unsigned()->references('book_id')->on('books');
            $table->integer('tag_id')->unsigned()->references('tag_id')->on('tags');
        });

        Schema::create('tags', function(Blueprint $table){
            $table->increments('id');
            $table->string('tag');
        });

        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('TAG');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('book_tag');
    }
}
