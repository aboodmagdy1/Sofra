<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{

	public function up()
	{
		Schema::create('meals', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->decimal('price', 10, 8);
			$table->decimal('offer_price', 10, 8);
			$table->integer('ready_time');
			$table->text('description');
			$table->integer('restaurant_id')->unsigned();
			$table->string('image');
		});
	}

	public function down()
	{
		Schema::drop('meals');
	}
}
