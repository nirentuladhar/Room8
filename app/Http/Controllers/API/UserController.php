<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{


    /**
     * @GET
     * Display a listing of all the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Store a newly created user in storage.
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
     * Display a specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        UserResource::withoutWrapping();
        return new UserResource($user);
    }

    /**
     * Update the specified user in storage.
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
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json(["status" => "OK"], 200);
        }
        return response()->json(["status" => "ERROR"], 403);

    }

    /**
     * @GET
     * Display specified user's houses
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function allHouses(User $user)
    {
        $response["user"] = $user->makeHidden('houses');
        $response["houses"] = $user->houses;
        $response["links"] = array(
            "self" => route('users.houses', ['id' => $user->id]),
        );

        foreach ($user->houses as $house) {
            $house_array[$house->id] = route('houses.show', $house->id);
        }
        $response["links"]["houses"] = $house_array;

        return response()->json($response, 200);
    }

    public function allGroups(User $user)
    {
        $response["user"] = $user->makeHidden('groups');
        $response["groups"] = $user->groups->makeHidden('pivot');
        $response["links"] = array(
            "self" => route('users.groups', ['id' => $user->id]),
        );

        foreach ($user->groups as $group) {
            $group_array[$group->id] = route('groups.show', $group->id);
        }
        $response["links"]["groups"] = $group_array;

        return response()->json($response, 200);
    }
}
