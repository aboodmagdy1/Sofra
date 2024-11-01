<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{

	public function up()
	{
		Schema::create('clients', function (Blueprint $table) {
			$table->timestamps();
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->integer('district_id')->unsigned();
			$table->string('password');
			$table->string('reset_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
