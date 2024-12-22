<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\location;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $location=location::create([
            'user_id'=>2, 
            'area'=>'Juja, Kenya', 
            'street'=>'K road', 
            'building'=>'Juja city mall',
        ]);

    }
}
