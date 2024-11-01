<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionTable extends Migration
{

	public function up()
	{
		Schema::create('commission', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('resturant_id')->unsigned();
			$table->decimal('amount');
			$table->text('details');
		});
	}

	public function down()
	{
		Schema::drop('commission');
	}
}
