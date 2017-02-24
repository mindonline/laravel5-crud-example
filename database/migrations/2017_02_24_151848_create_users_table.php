<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
			$table->integer('id', true)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->string('email')->nullable();
			$table->string('password')->nullable();
			$table->date('birthday')->nullable();
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->string('patname')->nullable();
			$table->integer('city_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
