<?php

namespace Database\Seeders;

use App\Models\OptionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flavor = OptionGroup::where('name', 'like', '%Flavor%')->first()->id;
        $icing = OptionGroup::where('name', 'like', '%Icing%')->first()->id;
            
        $items = [
            [
                'group_id' => $icing,
                'name' => ['en'=>'Icing', 'el'=>'Icing'],
            ],
            [
                'group_id' => $flavor,
                'name' => ['en'=>'Cheese Brownies', 'el'=>'Cheese Brownies'],
            ],
            [
                'group_id' => $flavor,
                'name' => ['en'=>'Δούκισσα', 'el'=>'Δούκισσα'],
            ],
            [
                'group_id' => $flavor,
                'name' => ['en'=>'Άσπρη Δούκισσα', 'el'=>'Άσπρη Δούκισσα'],
            ],
            [
                'group_id' => $flavor,
                'name' => ['en'=>'Brownies', 'el'=>'Brownies'],
            ],
            [
                'group_id' => $flavor,
                'name' => ['en'=>'Fruits', 'el'=>'Φρούτα'],
            ],
        ];

        foreach ($items as $item) {
            \App\Models\Option::create($item);
        }
            
    }
}
