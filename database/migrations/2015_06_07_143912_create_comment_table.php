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
		Schema::create('comment', function(Blueprint $table)
		{
			$table->integer('contentKey')->unsigned();	
			$table->foreign('contentKey')->references('contentKey')->on('contentInfo');
			$table->integer('#comment');
			$table->integer('userKey')->unsigned();	
			$table->foreign('userKey')->references('userKey')->on('users');
			$table->timestamps();
			$table->string('comment');
			$table->integer('commentRating');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Sehema::drop('comment');
	}

}
