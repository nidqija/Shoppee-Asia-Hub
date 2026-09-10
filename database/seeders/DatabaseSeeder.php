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
            'phone_number'=> 111111111111,
            'status' => 'active',
        ]);

        $sgSeller = User::on('central')->updateOrCreate(['email' => 'seller_sg@example.com'],[
            'password' => Hash::make('password123'),
            'home_region' => 'SG',
            'phone_number'=> 222222222222,
            'status' => 'active',
        ]);
        

        DB::setDefaultConnection('shard_my');

        // 1. Electronics - Wireless Noise-Cancelling Headphones
        Product::updateOrCreate(
            ['title' => 'AeroSound Pro Wireless ANC Headphones'],
            [
                'description' => 'Engineered for audiophiles and daily commuters alike, the AeroSound Pro delivers industry-leading hybrid active noise cancellation (up to -38dB) powered by dual-feed microphones. Featuring custom 40mm graphene dynamic drivers, it reproduces ultra-clear highs, rich mids, and punchy deep bass. Enjoy up to 45 hours of non-stop playback with quick USB-C fast charging (10 mins gives 4 hours), multipoint Bluetooth 5.3 connectivity, and memory-foam ear cushions wrapped in breathable protein leather.',
                'price' => 389.00,
                'region_code' => 'MY',
                'category_slug' => 'electronics',
                'stock_quantity' => 45,
                'status' => 'active',
                'warranty_period' =>12,
                'seller_id' => $mySeller->id,
            ]
        );

        // 2. Electronics / Wearables - Smartwatch
        Product::updateOrCreate(
            ['title' => 'PulseFit Horizon GPS Smartwatch'],
            [
                'description' => 'The PulseFit Horizon is an all-terrain fitness companion featuring a vibrant 1.43-inch Always-On AMOLED display shielded by sapphire glass. Track heart rate variability, SpO2 blood oxygen, continuous sleep stages, and over 120 sports modes with dual-frequency GPS positioning. Water-resistant up to 5ATM (50 meters) and equipped with an ultra-efficient battery yielding up to 14 days on a single charge.',
                'price' => 549.00,
                'region_code' => 'MY',
                'category_slug' => 'electronics',
                'stock_quantity' => 30,
                'status' => 'active',
                'warranty_period' =>12,
                'seller_id' => $mySeller->id,
            ]
        );

        // 3. Home & Living - Ergonomic Office Chair
        Product::updateOrCreate(
            ['title' => 'ErgoPosture Mesh Desk Chair - Carbon Edition'],
            [
                'description' => 'Designed to prevent lower-back fatigue during 8+ hour workdays, this ergonomic chair features dynamic adaptive lumbar support that auto-adjusts to your spine angle. Fitted with breathable, high-tensile German mesh, a 3D adjustable padded headrest, 4D armrests (height, angle, depth, and pivot), and a heavy-duty Class-4 gas lift rated for up to 150kg.',
                'price' => 720.00,
                'region_code' => 'MY',
                'category_slug' => 'home-living',
                'stock_quantity' => 18,
                'status' => 'active',
                'warranty_period' =>12,
                'seller_id' => $mySeller->id,
            ]
        );

        // 4. Kitchen Appliances - Compact Espresso Machine
        Product::updateOrCreate(
            ['title' => 'BaristaCraft Compact 15-Bar Espresso Machine'],
            [
                'description' => 'Bring third-wave café coffee into your kitchen. Built with a genuine Italian 15-bar ULKA pump and instant ThermoBlock fast-heating technology (ready in 25 seconds). Includes a professional 51mm stainless steel portafilter, commercial-grade steam wand for microfoam latte art, a removable 1.2L BPA-free water tank, and a cup warming top plate.',
                'price' => 429.00,
                'region_code' => 'MY',
                'category_slug' => 'kitchen-appliances',
                'stock_quantity' => 25,
                'status' => 'active',
                'warranty_period' =>12,
                'seller_id' => $mySeller->id,
            ]
        );

        // 5. Groceries / Local Specialties - Premium White Coffee
        Product::updateOrCreate(
            ['title' => 'Ipoh Heritage 3-in-1 Roasted White Coffee (15 Sachets x 40g)'],
            [
                'description' => 'Authentic slow-roasted Ipoh white coffee crafted according to traditional Hainanese recipes. Blended from select Arabica and Robusta beans roasted with palm-oil margarine at low temperatures to eliminate sour acidity and burnt bitterness. Produces a smooth, frothy cup with a distinctive nutty aroma and lingering caramel finish. Halal-certified and free from artificial colorings.',
                'price' => 16.80,
                'region_code' => 'MY',
                'category_slug' => 'groceries',
                'stock_quantity' => 250,
                'status' => 'active',
                'warranty_period' =>1,
                'seller_id' => $mySeller->id,
            ]
        );

        

        DB::setDefaultConnection('shard_sg');

        Product::updateOrCreate(['title' => 'SG Product 1'],[
            'description' => 'This is a product from Singapore.',
            'price' => 150.00,
            'region_code' => 'SG',
            'category_slug' => 'fashion',
            'stock_quantity' => 50,
            'status' => 'active',
            'seller_id' => $sgSeller->id,
        ]);

        

        

    }
}
