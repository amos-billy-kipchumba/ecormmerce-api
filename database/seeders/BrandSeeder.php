<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brands;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'Samsung',
            'Apple',
            'Sony',
            'LG',
            'Nokia',
            'Huawei',
            'Motorola',
            'OnePlus',
            'Xiaomi',
            'Google',
            'Eshop'
        ];

        foreach ($brands as $brand) {
            Brands::create([
                'name' => $brand
            ]);
        }
    }
}

