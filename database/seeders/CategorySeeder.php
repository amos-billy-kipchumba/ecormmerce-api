<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\categories; 

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Electronics',
            'Furniture',
            'Clothing',
            'Home Appliances',
            'Sports',
            'Beauty & Personal Care',
            'Books',
            'Toys & Games',
            'Automotive',
            'Groceries'
        ];

        foreach ($categories as $category) {
            categories::create([
                'name' => $category
            ]);
        }
    }
}


