<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_profile', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('phone_number', 15);
			$table->string('mobile_number', 15);
			$table->string('address', 300);
			$table->string('city', 150);
			$table->string('state', 150);
			$table->string('zip', 10);
			$table->string('profile_pic', 300);
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
		Schema::drop('user_profile');
	}

}
