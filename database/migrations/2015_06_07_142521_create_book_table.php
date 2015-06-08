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
		Schema::create('contentInfo', function(Blueprint $table)
		{
			$table->increments('contentKey');
			$table->String('name');
			$table->String('description');
			$table->integer('userRatingCount');
			$table->double('userRating',20,2);
			$table->double('criticRating',10,2);
			$table->String('TAG');
			$table->String('category');
		});

		Schema::create('sample_content', function(Blueprint $table){
			$table->integer('contentKey')->unsigned();	
			$table->foreign('contentKey')->references('contentKey')->on('contentInfo');
			$table->integer('chapter');
			$table->String('data');
		});


		Schema::create('book', function(Blueprint $table)
		{
			$table->increments('bookKey');
			$table->integer('contentKey')->unsigned();
			$table->foreign('contentKey')->references('contentKey')->on('contentInfo');
			$table->timestamps();
		});


		Schema::create('catalog', function(Blueprint $table){
			$table->integer('userKey')->unsigned();
			$table->foreign('userKey')->references('userKey')->on('users');
			$table->integer('bookKey')->unsigned();
			$table->foreign('bookKey')->references('bookKey')->on('book');
			$table->increments('catalogKey');
			$table->double('price',10,2);
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
	    Schema::dropIfExists('book');
		Schema::dropIfExists('catalog');
		Schema::dropIfExists('sample_content');
		Schema::dropIfExists('contentInfo');
	    DB::statement('SET FOREIGN_KEY_CHECKS = 1');

	}

}
