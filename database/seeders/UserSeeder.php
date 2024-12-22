<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $admin=User::create([
            'name'=>'Super Admin', 
            'phone'=>'+254700000000', 
            'email'=>'admin@eshop.com', 
            'password'=>Hash::make('eshop101'), 
            'role_id'=>1
        ]);



        $user=User::create([
            'name'=>'Test User', 
            'phone'=>'+254700000089', 
            'email'=>'user@eshop.com',
            'password'=>Hash::make('eshop101'), 
            'role_id'=>2
        ]);

    }
}
