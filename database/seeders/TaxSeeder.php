<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
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
                'name' => ['en' => 'VAT 19%', 'el' => 'ΦΠΑ 19%'],
                'percentage' => 19,
                'isDefault' => 1,
            ],
            [
                'name' => ['en' => 'VAT 5%', 'el' => 'ΦΠΑ 5%'],
                'percentage' => 5,
            ],
        ];
        foreach($items as $item){
            \App\Models\Tax::create($item);
        }
    }
}
