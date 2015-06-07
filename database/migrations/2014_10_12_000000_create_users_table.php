<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('userKey');
			$table->integer('userID');
			$table->string('firstName');
			$table->string('lastName');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->tinyInteger('userLevel');
			$table->timestamps();
		});

		Schema::create('wallet', function(Blueprint $table)
		{
			$table->integer('userKey')->unsigned();
			$table->foreign('userKey')->references('userKey')->on('users');
			$table->double('bankAccount',15,8);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Sehema::drop('wallet');
		Schema::drop('users');
	}

}
