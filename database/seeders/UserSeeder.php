<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [[
            'name' => 'Andreas Aresti',
            'email' => 'a.aresti@fosetico.com',
            'password' => bcrypt('123456'),
        ]];
        foreach($users as $user){
            \App\Models\User::create($user);
        }
    }
}
