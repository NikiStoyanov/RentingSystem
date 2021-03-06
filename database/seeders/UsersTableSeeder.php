<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'Nikolay',
            'email' => 'nikistoyanov2005@gmail.com',
            'password' => bcrypt('Niki_2005'),
            'role' => 'admin'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Viktor',
            'email' => 'vikivukev@gmail.com',
            'password' => bcrypt('Viki_2005')
        ]);
        $user->save();
    }
}
