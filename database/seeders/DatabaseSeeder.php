<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            TaxSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CategoryProductSeeder::class,
            OptionGroupSeeder::class,
            OptionSeeder::class,
            VariantSeeder::class,
            OptionVariantSeeder::class,
            FilterGroupSeeder::class,
            FilterSeeder::class,

        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
