<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => ['en' => 'Category 1', 'el' => 'Κατηγορία 1'],
                'description' => ['en' => '', 'el' => ''],
            ],
            [
                'name' => ['en' => 'Category 2', 'el' => 'Κατηγορία 2'],
                'description' => ['en' => '', 'el' => ''],
            ],
            [
                'name' => ['en' => 'Category 3', 'el' => 'Κατηγορία 3'],
                'description' => ['en' => '', 'el' => ''],
            ],
        ];
        foreach($categories as $category){
            \App\Models\Category::create($category);
        }

    }
}
