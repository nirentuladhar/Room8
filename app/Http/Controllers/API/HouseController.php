<?php

namespace App\Http\Controllers\API;

use App\House;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HouseController extends Controller
{

    private function returnValidHouse($id)
    {
        $house = House::find($id);
        if (!is_null($house)) {
            return $house;
        } else {
            return false;
        }
    }

    /**
     * @GET
     * @route : houses.
     * Display a listing of the houses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response["houses"] = House::all();
        $response["links"]["self"] = route('houses.index');
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
        //
    }

    /**
     * @GET
     * Display the specified house.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house = $this->returnValidHouse($id);
        if (!is_null($house)) {
            $response["house"] = $house;
            $response["links"]["self"] = route('houses.show', $id);
            return response()->json($response, 200);
        } else {
            return response()->json(["error" => "No house found."]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
