<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilterGroupSeeder extends Seeder
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
                'name' => [ 'en'=> 'Event Type', 'el'=> 'Τύπος Εκδήλωσης' ],
            ],
            [
                'name' => [ 'en'=> 'Theme', 'el'=> 'Θέμα' ],
            ],
            [
                'name' => ['en'=>'Gender', 'el'=>'Φύλο'],
            ],
        ];

        foreach ($items as $item) {
            \App\Models\FilterGroup::create($item);
        }
    }
}
