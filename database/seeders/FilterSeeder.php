<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
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
                'name' => ['en'=>'Birthday', 'el'=>'Γενέθλια'],
                'filter_group_id' => 1,
            ],
            [
                'name' => ['en'=>'Wedding', 'el'=>'Γαμος'],
                'filter_group_id' => 1,
            ],
            [
                'name' => ['en'=>'Bachelor Party', 'el'=>'Μπάτσελορ'],
                'filter_group_id' => 1,
            ],
            [
                'name' => ['en'=>'Anniversary', 'el'=>'Επέτειος'],
                'filter_group_id' => 1,
            ],
            [
                'name' => ['en'=>'Boy', 'el'=>'Αγόρι'],
                'filter_group_id' => 3,
            ],
            [
                'name' => ['en'=>'Girl', 'el'=>'Κορίτσι' ],
                'filter_group_id' => 3,
            ],
            [
                'name' => ['en'=>'Man', 'el'=>'Άντρας' ],
                'filter_group_id' => 3,
            ],
            [
                'name' => ['en'=>'Woman', 'el'=>'Γυναίκα' ],
                'filter_group_id' => 3,
            ],
            [
                'name' => ['en'=>'Κινούμενα Σχέδια', 'el'=>'Κινούμενα Σχέδια' ],
                'filter_group_id' => 2,
            ],
            [
                'name' => ['en'=>'Αθλητισμός', 'el'=>'Αθλητισμός' ],
                'filter_group_id' => 2,
            ],

        ];

        foreach ($items as $item) {
            \App\Models\Filter::create($item);
        }
    }
}
