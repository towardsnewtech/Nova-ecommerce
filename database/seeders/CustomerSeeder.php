<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Test Customer',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'phone' => '555-555-5555',
                'address' => '123 Main St',
                'city' => 'Testville',
            ],
        ];

        foreach($items as $item) {
            \App\Models\Customer::create($item);
        }
    }
}
