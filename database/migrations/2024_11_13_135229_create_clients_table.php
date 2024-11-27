<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration
{

	public function up()
	{
		Schema::create('clients', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->integer('district_id')->unsigned()->nullable();
			$table->string('password');
			$table->string('image')->nullable();
			$table->string('reset_code')->nullable();
			$table->boolean('is_active')->default(1);
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
