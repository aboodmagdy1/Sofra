<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificatinosTable extends Migration
{

	public function up()
	{
		Schema::create('notifications', function (Blueprint $table) {
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
		Schema::drop('notificatinos');
	}
}
