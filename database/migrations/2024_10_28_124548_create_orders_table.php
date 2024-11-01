<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->decimal('total_meals_price');
			$table->decimal('commission_price');
			$table->decimal('delivery_price');
			$table->decimal('total_price');
			$table->integer('payment_method_id')->unsigned();
			$table->text('note');
			$table->text('address');
			$table->tinyInteger('status');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
