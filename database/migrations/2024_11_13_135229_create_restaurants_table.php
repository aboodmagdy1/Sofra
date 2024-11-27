<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration
{

	public function up()
	{
		Schema::create('restaurants', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->boolean('status')->comment('0 => closed , 1 => open');
			$table->boolean('is_active')->default(1);
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('contact_num');
			$table->string('watts_num');
			$table->decimal('min_order_price');
			$table->string('password');
			$table->decimal('delivery_price');
			$table->decimal('avg_rate')->nullable();
			$table->string('image')->nullable();
			$table->string('reset_code')->nullable();
			$table->integer('district_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
