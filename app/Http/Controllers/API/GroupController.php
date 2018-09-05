<?php

namespace App\Http\Controllers\API;

use App\Group;
use App\House;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['authorization.group'], ['except' => ['index', 'show', 'store']]);
        $this->middleware(['authorization.house'], ['only' => 'store']);
    }


    /**
     * @GET
     * @route : /groups
     * Display a listing of the groups.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response["groups"] = Group::all();
        $response["links"]["self"] = route('groups.index');
        return response()->json($response, 200);
    }

    /**
     *  @GET
     * @route : /groups/{group_id}
     * Store a newly created group in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, House $house)
    {
        $request->request->add(['house_id' => $house->id]);
        $validate = Validator::make($request->all(), Group::$storeRules);
        if (!$validate->fails()) {
            $group = new Group($request->all());
            if ($group->save()) {
                return response()->json(["status" => "CREATED"], 201); // 201 - created
            }
            return response()->json(["status" => "FAILED"], 400);
        } else {
            return response()->json($validate->errors(), 422);// 422 - unprocessable request
        }
    }

    /**
     * @GET
     * @route : /groups/{group_id}
     * Display the specified group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $response["group"] = $group;
        $response["links"]["self"] = route('groups.show', $group->id);
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


    /**
     * @GET
     * Display specified group's users
     *
     * @param  Group  $group
     * @return \Illuminate\Http\Response
     */

    public function allUsers(Group $group)
    {
        $response["group"] = $group->makeHidden(['users']);
        $response["users"] = $group->users;
        $response["links"] = array(
            "self" => route('groups.users', ['id' => $group->id]),
        );
        foreach ($group->users as $user) {
            $user_array[$user->id] = route('users.show', $user->id);
        }
        $response["links"]["users"] = $user_array;
        return response()->json($response, 200);
    }

    public function house(Group $group)
    {
        $response["group"] = $group->makeHidden(['house', 'house_id']);
        $response["house"] = $group->house;
        $response["links"] = array(
            "self" => route('groups.users', ['id' => $group->id]),
            "house" => route('houses.show', ['id' => $group->house_id])
        );
        return response()->json($response, 200);
    }

    public function allTransactions(Group $group)
    {
        $response["group"] = $group->makeHidden('transactions');
        $response["transactions"] = $group->transactions->makeHidden(['pivot', 'group_id']);
        $response["links"] = array(
            "self" => route('groups.transactions', ['id' => $group->id]),
        );

        foreach ($group->transactions as $transaction) {
            $transaction_array[$transaction->id] = route('transactions.show', $transaction->id);
        }
        $response["links"]["transactions"] = $transaction_array;

        return response()->json($response, 200);
    }
}
