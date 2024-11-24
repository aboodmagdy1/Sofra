<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration
{

	public function up()
	{
		Schema::table('restaurants', function (Blueprint $table) {
			$table->foreign('district_id')->references('id')->on('districts')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('districts', function (Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('reviews', function (Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('reviews', function (Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('meals', function (Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('clients', function (Blueprint $table) {
			$table->foreign('district_id')->references('id')->on('districts')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('orders', function (Blueprint $table) {
			$table->foreign('payment_method_id')->references('id')->on('payment_methods')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('orders', function (Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('orders', function (Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('meal_order', function (Blueprint $table) {
			$table->foreign('meal_id')->references('id')->on('meals')
				->onDelete('restrict')
				->onUpdate('restrict');
		});
		Schema::table('meal_order', function (Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
				->onDelete('restrict')
				->onUpdate('restrict');
		});
		Schema::table('category_restaurant', function (Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('category_restaurant', function (Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
				->onDelete('no action')
				->onUpdate('no action');
		});
		Schema::table('commission', function (Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
				->onDelete('no action')
				->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('restaurants', function (Blueprint $table) {
			$table->dropForeign('restaurants_district_id_foreign');
		});
		Schema::table('districts', function (Blueprint $table) {
			$table->dropForeign('districts_city_id_foreign');
		});
		Schema::table('reviews', function (Blueprint $table) {
			$table->dropForeign('reviews_restaurant_id_foreign');
		});
		Schema::table('reviews', function (Blueprint $table) {
			$table->dropForeign('reviews_client_id_foreign');
		});
		Schema::table('meals', function (Blueprint $table) {
			$table->dropForeign('meals_restaurant_id_foreign');
		});
		Schema::table('clients', function (Blueprint $table) {
			$table->dropForeign('clients_district_id_foreign');
		});
		Schema::table('orders', function (Blueprint $table) {
			$table->dropForeign('orders_payment_method_id_foreign');
		});
		Schema::table('orders', function (Blueprint $table) {
			$table->dropForeign('orders_restaurant_id_foreign');
		});
		Schema::table('orders', function (Blueprint $table) {
			$table->dropForeign('orders_client_id_foreign');
		});
		Schema::table('meal_order', function (Blueprint $table) {
			$table->dropForeign('meal_order_meal_id_foreign');
		});
		Schema::table('meal_order', function (Blueprint $table) {
			$table->dropForeign('meal_order_order_id_foreign');
		});
		Schema::table('category_restaurant', function (Blueprint $table) {
			$table->dropForeign('category_restaurant_category_id_foreign');
		});
		Schema::table('category_restaurant', function (Blueprint $table) {
			$table->dropForeign('category_restaurant_restaurant_id_foreign');
		});
		Schema::table('commission', function (Blueprint $table) {
			$table->dropForeign('commission_restaurant_id_foreign');
		});
	}
}
