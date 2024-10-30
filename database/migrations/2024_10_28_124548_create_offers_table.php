<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{

	public function up()
	{
		Schema::create('offers', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image');
			$table->string('name');
			$table->text('description');
			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->integer('restaurant_id');
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}
