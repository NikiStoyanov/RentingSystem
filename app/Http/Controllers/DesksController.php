<?php

namespace App\Http\Controllers;

use App\Models\Desk;
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
        $size = $request->input('size');
        $position = $request->input('position');

        $desk = new Desk([
            'is_taken' => $is_taken,
            'price' => $price,
            'size' => $size,
            'position' => $position
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
        $size = $request->input('size');
        $position = $request->input('position');


        $desk = Desk::findOrFail($id);

        $desk->is_taken = $is_taken;
        $desk->price = $price;
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
}
