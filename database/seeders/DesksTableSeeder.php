<?php

namespace Database\Seeders;

use App\Models\Desk;
use Illuminate\Database\Seeder;

class DesksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desk = new Desk([
            'is_taken' => true,
            'price' => 150.00,
            'size' => 'large',
            'position' => 'next to the window',
            'room_id' => 1
        ]);
        $desk->save();

        $desk = new Desk([
            'is_taken' => false,
            'price' => 250.00,
            'size' => 'small',
            'position' => 'next to the door',
            'room_id' => 2
        ]);
        $desk->save();

        $desk = new Desk([
            'is_taken' => true,
            'price' => 200.00,
            'size' => 'medium',
            'position' => 'next to the wall',
            'room_id' => 1
        ]);
        $desk->save();
    }
}
