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
			// $table->integer('userKey')->unsigned();
			// $table->foreign('userKey')->references('userKey')->on('users');

//			$table->integer('#comment');
//			$table->timestamps();
//			$table->increments('commentKey');
//			$table->string('comment');
//			$table->integer('commentRating');


			$table -> increments('commentKey');
			$table -> integer('ownerKey');
			$table -> integer('parentKey');
			$table -> integer('bookKey');
			$table -> string('comment');
			$table -> integer('rating')->default(0);
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('comments');
	}

}
