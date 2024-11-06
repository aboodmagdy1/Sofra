<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealOrderTable extends Migration {

	public function up()
	{
		Schema::create('meal_order', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('quantity');
			$table->integer('meal_id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->text('special_note');
			$table->decimal('meal_price');
		});
	}

	public function down()
	{
		Schema::drop('meal_order');
	}
}