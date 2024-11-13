<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('content');
			$table->tinyInteger('rate');
			$table->integer('restaurant_id')->unsigned();
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('reviews');
	}
}