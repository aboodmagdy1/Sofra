<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->text('body');
			$table->boolean('is_read');
			$table->morphs('notifyiable');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}