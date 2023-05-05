<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionGroupSeeder extends Seeder
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
                'name' => ['en'=>'Flavor', 'el'=>'Γεύση'],
                'multiple' => true,
                'required' => true,
            ],
            [
                'name' => ['en'=>'Icing', 'el'=>'Επικάλυψη'],
                'multiple' => false,
            ],            
        ];

        foreach($items as $item) {
            \App\Models\OptionGroup::create($item);
        }
    }
}

