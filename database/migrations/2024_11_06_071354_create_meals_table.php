<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealsTable extends Migration
{

	public function up()
	{
		Schema::create('meals', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->decimal('price');
			$table->decimal('offer_price')->nullable();
			$table->integer('ready_time');
			$table->text('description');
			$table->integer('restaurant_id')->unsigned();
			$table->string('image')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('meals');
	}
}
