<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRoomManagerShouldBeTheAdmin_IfNoRoomManagerIdIsGiven()
    {
        $room = new Room([
            'desk_capacity' => 100,
            'size' => 'medium'
        ]);
        $room->save();

        $room2 = Room::findOrFail($room->id);

        $this->assertEquals('1', $room2->user_id);
    }

    public function testRoomSizeUpdating()
    {
        $room = new Room([
            'desk_capacity' => 100,
            'size' => 'medium'
        ]);
        $room->save();

        $room = Room::findOrFail($room->id);

        $room->size = 'large';

        $room->save();

        $this->assertEquals('large', $room->size);
    }
}
