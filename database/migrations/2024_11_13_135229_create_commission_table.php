<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommissionTable extends Migration
{

	public function up()
	{
		Schema::create('commission', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id')->unsigned();
			$table->decimal('amount');
			$table->text('details');
		});
	}

	public function down()
	{
		Schema::drop('commission');
	}
}
