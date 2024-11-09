<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{

	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->decimal('cost'); //سعر الطلب بدون العمولة
			$table->decimal('commission_price'); //العمولة
			$table->decimal('delivery_price'); // سعر التوصيل
			$table->decimal('total_price'); // السعر الكلي
			$table->decimal('net');
			$table->integer('payment_method_id')->unsigned();
			$table->text('note');
			$table->text('address');
			$table->tinyInteger('status');
			$table->integer('restaurant_id')->unsigned();
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
