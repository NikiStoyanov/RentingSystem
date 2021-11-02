<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class DesksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desks = Desk::All();

        $response = [
            'msg' => 'List of all desks',
            'desks' => $desks
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
        $is_taken = $request->input('is_taken');
        $price = $request->input('price');
        $room_id = $request->input('room_id');
        $size = $request->input('size');
        $position = $request->input('position');

        $desk = new Desk([
            'is_taken' => $is_taken,
            'price' => $price,
            'size' => $size,
            'position' => $position,
            'room_id' => $room_id
        ]);
        $desk->save();

        $response = [
            'msg' => 'Desk created',
            'desk' => $desk
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
                'msg' => 'You haven\'t rent the desk yet.'
            ];

            return response()->json($response, 401);
        }

        $desk = Desk::findOrFail($id);

        $response = [
            'msg' => 'Desk Information',
            'desk' => $desk
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
        $is_taken = $request->input('is_taken');
        $price = $request->input('price');
        $room_id = $request->input('room_id');
        $size = $request->input('size');
        $position = $request->input('position');


        $desk = Desk::findOrFail($id);

        $desk->is_taken = $is_taken;
        $desk->price = $price;
        $desk->room_id = $room_id;
        $desk->size = $size;
        $desk->position = $position;

        $desk->update();

        $response = [
            'msg' => 'Desk updated',
            'desk' => $desk
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desk = Desk::findOrFail($id);

        $desk->delete();

        $response = [
            'msg' => 'Desk deleted',
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

    /**
     * @param int  $desk_id
     * @param int  $renter_id
     * @return \Illuminate\Http\Response
     */
    public function rent(int $desk_id, int $renter_id){

        $desk = Desk::findOrFail($desk_id);

        if ($desk->is_taken) {
            $response = [
                'msg' => 'The desk is taken'
            ];

            return response()->json($response, 200);
        }

        $renter = User::findOrFail($renter_id);


        $desk->user_id = $renter_id;

        $response = [
            'msg' => 'User assigned to the given room successfully.',
            'desk' => $desk,
            'renter' => $renter
        ];

        return response()->json($response, 201);
    }
}
