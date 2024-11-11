<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\District;
use App\Models\PaymentMethod;
use App\Models\Restaurant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        City::create(['name' => 'المنصوره']);
        District::create(['name' => 'حي الجامعه', 'city_id' => 1]);

        Client::create([
            'phone' => '01000000000',
            'name' => 'client-1',
            'email' => 'client-1@gmail.com',
            'password' => Hash::make('client'),
            'district_id' => 1,
        ]);

        PaymentMethod::create(['name' => 'cash']);

        Category::create(['name' => 'وجبات سريعه']);
        Restaurant::create([
            'name' => 'restaurant-1',
            'email' => 'rest-1@gmail.com',
            'phone' => '01000000000',
            'contact_num' => '01010000000',
            'watts_num' => '01020000000',
            'district_id' => 1,
            'min_order_price' => 20,
            'delivery_price' => 5,
            'status' => 1,
            'password' => bcrypt('rest'),
        ]);
    }
}
