<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
			$table->increments('bookKey');
			$table->integer('ownerKey');
			// ->unsigned()->references('userKey')->on('users');
			$table->String('name');
			$table->String('description');
			$table->integer('userRatingCount');
			$table->double('userRating',20,2);
			$table->double('criticRating',10,2);
			$table->String('TAG');
			$table->String('category');
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
		Schema::dropIfExists('books');
	}

}
