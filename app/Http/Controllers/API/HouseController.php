<?php

namespace App\Http\Controllers\API;

use App\House;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HouseController extends Controller
{

    /**
     * @GET
     * @route : /houses
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
     * @route : /houses/{house_id}
     * Display the specified house.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        $response["house"] = $house;
        $response["links"]["self"] = route('houses.show', $house->id);
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

    public function allGroups(House $house)
    {
        $response["house"] = $house->makeHidden('groups');
        $response["groups"] = $house->groups->makeHidden('pivot');
        $response["links"] = array(
            "self" => route('houses.groups', ['id' => $house->id]),
        );

        foreach ($house->groups as $group) {
            $group_array[$group->id] = route('groups.show', $group->id);
        }
        $response["links"]["groups"] = $group_array;

        return response()->json($response, 200);
    }

    public function allUsers(House $house)
    {
        $hidden = ['created_at', 'updated_at', 'users', 'pivot'];
        $response["house"] = $house->makeHidden($hidden);
        $response["users"] = $house->users->makeHidden($hidden);
        $response["links"] = array(
            "self" => route('houses.users', ['id' => $house->id]),
        );
        foreach ($house->users as $user) {
            $user_array[$user->id] = route('users.show', $user->id);
        }
        $response["links"]["users"] = $user_array;
        return response()->json($response, 200);
    }
}
