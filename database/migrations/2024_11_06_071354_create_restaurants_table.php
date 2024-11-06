<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->boolean('status');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('contact_num');
			$table->string('watts_num');
			$table->decimal('min_order_price');
			$table->string('password');
			$table->decimal('delivery_price');
			$table->decimal('avg_rate');
			$table->string('image');
			$table->string('reset_code')->nullable();
			$table->integer('district_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}