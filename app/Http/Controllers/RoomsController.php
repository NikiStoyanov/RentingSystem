<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::All();

        $response = [
            'msg' => 'List of all rooms',
            'rooms' => $rooms
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $size = $request->input('size');
        $desk_capacity = $request->input('desk_capacity');
        $user_id = $request->input('user_id');

        $room = new Room([
            'size' => $size,
            'desk_capacity' => $desk_capacity,
            'user_id' => $user_id
        ]);
        $room->save();

        $response = [
            'msg' => 'Room created',
            'room' => $room
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);

        $response = [
            'msg' => 'Room Information',
            'room' => $room
        ];

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $size = $request->input('size');
        $desk_capacity = $request->input('desk_capacity');
        $user_id = $request->input('user_id');

        $room = Room::findOrFail($id);
        $room->size = $size;
        $room->desk_capacity = $desk_capacity;
        $room->user_id = $user_id;
        $room->update();

        $response = [
            'msg' => 'Room updated',
            'room' => $room
        ];

        return response()->json($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        $room->delete();

        $response = [
            'msg' => 'Room deleted',
        ];

        return response()->json($response, 200);
    }
}
