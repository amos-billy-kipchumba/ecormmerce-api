<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\products;
use App\Models\categories;
use App\Models\Brands;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Real product data
        $products = [
            [
                'name' => 'Custom Basket',
                'image' => '1.webp',
                'price_range' => [999, 1299],
                'category_id'=>4,
                'brand_id'=>11,
            ],
            [
                'name' => 'Classic Watch',
                'image' => '2.webp',
                'price_range' => [1199, 1399],
                'category_id'=>1,
                'brand_id'=>1,
            ],
            [
                'name' => 'Clock',
                'image' => '3.webp',
                'price_range' => [2499, 2899],
                'category_id'=>1,
                'brand_id'=>4,
            ],
            [
                'name' => 'Dark Shades Glasses',
                'image' => '4.webp',
                'price_range' => [599, 799],
                'category_id'=>3,
                'brand_id'=>11,
            ],
            [
                'name' => 'Cool Cap',
                'image' => '5.webp',
                'price_range' => [349, 399],
                'category_id'=>3,
                'brand_id'=>11,
            ],
            [
                'name' => 'Head Phone',
                'image' => '6.webp',
                'price_range' => [1699, 2299],
                'category_id'=>1,
                'brand_id'=>3,
            ],
            [
                'name' => 'Glass Table',
                'image' => '7.webp',
                'price_range' => [399, 499],
                'category_id'=>2,
                'brand_id'=>11,
            ],
            [
                'name' => 'Black Bag',
                'image' => '8.webp',
                'price_range' => [899, 999],
                'category_id'=>3,
                'brand_id'=>11,
            ],
            [
                'name' => 'White Bag',
                'image' => '9.webp',
                'price_range' => [899, 999],
                'category_id'=>3,
                'brand_id'=>11,
            ],
            [
                'name' => 'Colored Printer',
                'image' => '10.webp',
                'price_range' => [899, 1099],
                'category_id'=>1,
                'brand_id'=>4,
            ],
        ];


        foreach ($products as $product) {
            products::create([
                'category_id' => $product['category_id'],
                'brand_id' => $product['brand_id'],
                'name' => $product['name'],
                'price' => $faker->randomFloat(2, $product['price_range'][0], $product['price_range'][1]),
                'stock' => $faker->numberBetween(5, 50),
                'image' => $product['image'],
                'description' => $faker->paragraph(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}