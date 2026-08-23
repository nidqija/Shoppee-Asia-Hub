<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Region;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // create regions in the central database
        // this is for sharding purposes, each region will have its own shard database
        // for now , MY and SG
        // NOTE : ensure that the columns matches the columns in the migration files for each table, otherwise it will throw an error.

        // extend any new region here , to create a new shard database for that region
        Region::on('central')->updateOrCreate(['code' => 'MY'],[
            
            'name' => 'Malaysia',
            'currency_code' => 'MYR',
            'shard_connection' => 'shard_my',
            'is_active' => true,
        ]);


         Region::on('central')->updateOrCreate(['code' => 'SG'],[
            
            'name' => 'Singapore',
            'currency_code' => 'SGD',
            'shard_connection' => 'shard_sg',
            'is_active' => true,

        ]);

        $mySeller = User::on('central')->updateOrCreate(['email' => 'seller_my@example.com'],[
            'password' => Hash::make('password123'),
            'home_region' => 'MY',
            'status' => 'active',
        ]);

        $sgSeller = User::on('central')->updateOrCreate(['email' => 'seller_sg@example.com'],[
            'password' => Hash::make('password123'),
            'home_region' => 'SG',
            'status' => 'active',
        ]);
        

        DB::setDefaultConnection('shard_my');

        Product::updateOrCreate(['title' => 'MY Product 1'],[
            'description' => 'This is a product from Malaysia.',
            'price' => 100.00,
            'region_code' => 'MY',
            'category_slug' => 'electronics',
            'status' => 'active',
        ]);

        DB::setDefaultConnection('shard_sg');

        Product::updateOrCreate(['title' => 'SG Product 1'],[
            'description' => 'This is a product from Singapore.',
            'price' => 150.00,
            'region_code' => 'SG',
            'category_slug' => 'fashion',
            'status' => 'active',
        ]);

        

    }
}
