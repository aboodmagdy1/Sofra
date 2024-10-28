<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificatinosTable extends Migration
{

	public function up()
	{
		Schema::create('notificatinos', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->text('body');
		});
	}

	public function down()
	{
		Schema::drop('notificatinos');
	}
}
