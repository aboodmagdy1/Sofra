<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{

	public function up()
	{
		Schema::create('settings', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('about');
			$table->integer('commission')->nullable()->default(0); // Precision 8, Scale 2
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
