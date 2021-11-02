<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role:admin');
        $this->middleware('auth.role:room_manager');
    }

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
        $user = User::findOrFail(auth()->user()->getAuthIdentifier());

        if ($user->room_id != $id) {
            $response = [
                'msg' => 'You aren\'t room manager of this room.'
            ];

            return response()->json($response, 401);
        }

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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $room = Room::findOrFail($id);

        $room->desks()->delete();

        $room->delete();

        $response = [
            'msg' => 'Room deleted',
        ];

        return response()->json($response, 200);
    }

    /**
     * @param int  $room_id
     * @param int  $room_manager_id
     * @return \Illuminate\Http\Response
     */
    public function assign(int $room_id, int $room_manager_id){
        $room = Room::findOrFail($room_id);

        $room_manager = User::findOrFail($room_manager_id);

        if ($room_manager->role != 'room_manager') {
            $room_manager->role = 'room_manager';
        }
        else {

            $response = [
                'msg' => 'Cannot assign this user to the given room'
            ];

            return response()->json($response, 400);
        }

        $room->room_manager_id = $room_manager_id;

        $response = [
            'msg' => 'User assigned to the given room successfully.',
            'room' => $room,
            'room_manager' => $room_manager
        ];

        return response()->json($response, 201);
    }
}
