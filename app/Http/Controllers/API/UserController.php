<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    private function returnValidUser($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            return $user;
        } else {
            return false;
        }
    }

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
        //$user = $this->returnValidUser($id);
        if ($user) {
            UserResource::withoutWrapping();
            return new UserResource($user);
        } else {
            return response()->json(['error' => 'No user found']);
        }
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
    public function destroy($id)
    {
        //
    }

    /**
     * @GET
     * Display specified user's houses
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allHouses($id)
    {
        $user = $this->returnValidUser($id);
        if ($user) {
            $response["user"] = $user->makeHidden('houses');
            $response["houses"] = $user->houses;
            $response["links"] = array(
                "self" => route('users.houses', ['id' => $id]),
            );

            foreach ($user->houses as $house) {
                $house_array[$house->id] = route('houses.show', $house->id);
            }
            $response["links"]["houses"] = $house_array;

            return response()->json($response, 200);
        }

        return response()->json(["error" => "No user found"]);
    }
}
