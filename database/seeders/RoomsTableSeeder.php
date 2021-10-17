<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $room = new Room([
            'size' => 'small',
            'user_id' => 1,
            'desk_capacity' => 20
        ]);
        $room->save();

        $room = new Room([
            'size' => 'big',
            'user_id' => 2,
            'desk_capacity' => 100
        ]);
        $room->save();
    }
}
