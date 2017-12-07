<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post_comments', function(Blueprint $table)
		{
			$table->foreign('post_id', 'post_comments_ibfk_1')->references('id')->on('posts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'post_comments_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post_comments', function(Blueprint $table)
		{
			$table->dropForeign('post_comments_ibfk_1');
			$table->dropForeign('post_comments_ibfk_2');
		});
	}

}
