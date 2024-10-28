<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{

	public function up()
	{
		Schema::create('restaurants', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->boolean('status');
			$table->string('name');
			$table->integer('district_id')->unsigned();
			$table->decimal('min_order_price', 10, 8);
			$table->decimal('delivery_price', 10, 8);
			$table->decimal('avg_rate', 10, 8);
			$table->string('mobile');
			$table->string('watts_number');
			$table->string('image');
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
