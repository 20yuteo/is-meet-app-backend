<?php

namespace App\Repositories\Room;
use App\Models\User;
use Illuminate\Http\Request;

interface RoomRepositoryInterface {

    /**
     * create new Room
     * @param \App\Models\User
     * @param array
     * @return boolean
     * 
     */
    public function create(User $user, array $room_array);

    /**
     * find by room name
     * @param string
     * @return \App\Models\Room
     * 
     */
    public function findByName(string $name);

    /**
     * find room by token
     * @param string $token
     * @return mixed
     * 
     */
    public function findByToken(string $token);

    /**
     * member join room.
     * @return array
     */
    public function joinRoom(string $name, string $token);

    /**
     * fetch users all rooms.
     * @param number $user_id
     * @return object $response
     * 
     */
    public function fetchUsersAllRooms(int $user_id);

    /**
     * fetch all rooms
     * 
     */
    public function fetchAllRooms();

    /**
     * update room data.
     * 
     */
    public function updateRoom(Request $request);

    /**
     * find by id
     * 
     */
    public function findById(int $id);

    /**
     * delete room data.
     * 
     */
    public function deleteRoom(int $id);
}