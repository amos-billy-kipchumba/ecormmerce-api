<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\order_items;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        $order_item=order_items::create([
            'order_id'=>1, 
            'product_id'=>1, 
            'price'=> $faker->randomFloat(2, 899, 1099),
            'quantity'=>1,
        ]);

    }
}
