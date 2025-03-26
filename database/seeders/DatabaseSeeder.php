<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Database\Seeders\AdminSeeder;  
use Database\Seeders\CustomerSeeder; 
use Database\Seeders\SellerSeeder; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // AdminSeeder::class,
            CustomerSeeder::class,
            SellerSeeder::class,
        ]);
    }
}
