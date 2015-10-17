<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			// $table->integer('contentKey')->unsigned();
			// $table->foreign('contentKey')->references('contentKey')->on('contentInfo');
			$table->integer('#comment');
			// $table->integer('userKey')->unsigned();
			// $table->foreign('userKey')->references('userKey')->on('users');
			$table->timestamps();
			$table->increments('commentKey');
			$table->string('comment');
			$table->integer('commentRating');
		});

		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('userKey');
			$table->string('username')->unique();
			$table->string('firstName');
			$table->string('lastName');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->tinyInteger('userLevel');
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('wallets', function(Blueprint $table)
		{
			$table->increments('walletKey');
			$table->integer('userKey')->unsigned()->references('userKey')->on('users');
			$table->double('bankAccount',15,8);
		});

		Schema::create('books', function(Blueprint $table)
		{
			$table->increments('bookKey');
			$table->integer('ownerKey')->unsigned()->references('userKey')->on('users');
			$table->String('name');
			$table->String('description');
			$table->integer('userRatingCount');
			$table->double('userRating',20,2);
			$table->double('criticRating',10,2);
			$table->String('TAG');
			$table->String('category');
			$table->timestamps();
		});

		Schema::create('contents', function(Blueprint $table){
			$table->increments('contentKey');
			$table->String('name');
			$table->String('content');
			$table->double('chapter');
			$table->timestamps();
		});

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
	    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
	    Schema::dropIfExists('comments');
			Schema::dropIfExists('wallets');
			Schema::dropIfExists('users');
			Schema::dropIfExists('books');
			Schema::dropIfExists('contents');
	    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
