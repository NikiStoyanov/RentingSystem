<?php

namespace Tests\Feature;

use App\Models\Desk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DesksTest extends TestCase
{
    public function testCreatingADesk()
    {
        $desk = new Desk([
            'is_taken' => 100,
            'price' => 200.00,
            'size' => 'medium',
            'position' => 'next to the window'
        ]);
        $desk->save();

        $desk = Desk::findOrFail($desk->id);

        $this->assertEquals('medium', $desk->size);
    }

    public function testDeskPriceUpdating()
    {
        $desk = new Desk([
            'is_taken' => 100,
            'price' => 200.00,
            'size' => 'medium',
            'position' => 'next to the window'
        ]);
        $desk->save();

        $desk = Desk::findOrFail($desk->id);

        $desk->price = 150.00;

        $desk->save();

        $this->assertEquals(150, $desk->price);
    }
}
