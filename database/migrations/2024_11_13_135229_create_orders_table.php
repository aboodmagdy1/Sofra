<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->decimal('cost')->nullable()->default('0');
			$table->decimal('commission_price')->nullable()->default('0');
			$table->decimal('delivery_price')->nullable();
			$table->decimal('total_price')->nullable()->default('0');
			$table->integer('payment_method_id')->unsigned();
			$table->text('note');
			$table->text('address');
			$table->tinyInteger('status');
			$table->integer('restaurant_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->decimal('net')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}