<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotifyablesTable extends Migration
{

	public function up()
	{
		Schema::create('notifyables', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('notification_id')->unsigned();
			$table->morphs('notifyable');
		});
	}

	public function down()
	{
		Schema::drop('notifyables');
	}
}
