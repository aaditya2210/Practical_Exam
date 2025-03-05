<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StateSeeder::class,
            CitySeeder::class,
            // RoleSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
            RolePermissionSeeder::class,
        ]);
        
        $this->command->info("✅ Database seeding completed successfully!");
    }
}
