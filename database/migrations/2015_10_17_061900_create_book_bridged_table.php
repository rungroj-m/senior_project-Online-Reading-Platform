<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookBridgedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books_comments', function(Blueprint $table){
			$table->increments('id');

			$table->integer('bookKey')->unsigned()->references('bookKey')->on('books');
			$table->integer('commentKey')->unsigned()->references('commentKey')->on('comments');
			$table->integer('contentKey')->unsigned()->references('contentKey')->on('contents')
		});

		Schema::create('books_contents', function(Blueprint $table){
			$table->increments('id');

			$table->integer('bookKey')->unsigned()->references('bookKey')->on('books');
			$table->integer('contentKey')->unsinged()-references('contentKey')->on('contents');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('books_comments');
		Schema::dropIfExists('books_contents');
	}

}
