<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;
use App\Http\Requests\ShowRoomRequest;
use App\Models\User;
use App\UseCase\Room;
use App\Http\Resources\RoomResource;
use App\Http\Resources\RoomMemberResource;
use App\Http\Requests\JoinRoomRequest;

class RoomController extends Controller
{
    private $room_usecase;

    public function __construct(Room $room)
    {
        $this->room_usecase = $room;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $res = $this->room_usecase->fetchUsersAllRooms($user->id);
        return RoomResource::collection($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request, User $user)
    {
        $res = $this->room_usecase->createRoom($user, $request);
        return new RoomResource($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRoomRequest $request)
    {
        $res = $this->room_usecase->findByToken($request->token);
        return new RoomResource($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
