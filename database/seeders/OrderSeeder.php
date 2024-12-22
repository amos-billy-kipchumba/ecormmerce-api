<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\orders;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $order = orders::create([
            'user_id' => 2,
            'location_id' => 1,
            'total_price' => $faker->randomFloat(2, 899, 1099),
            'date_of_delivery' => Carbon::now()->addDays(3)->toDateString(),
            'status' => 'Pending',
        ]);
    }
}
