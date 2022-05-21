<?php

namespace App\Repositories\Room;

use App\Repositories\Room\RoomRepositoryInterface;
use App\Models\Room;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;

class RoomRepository implements RoomRepositoryInterface {

    private $room;

    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    /**
     * create new Room
     * @param \App\Models\User
     * @param array
     * @return boolean
     * 
     */
    public function create(User $user, array $room_array) {
        try {
            return $user->rooms()->save($this->room->fill($room_array))->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * find room by name
     * @param string
     * @return mixed
     * 
     */
    public function findByName(string $name) {
        try {
            return $this->room->where('name', $name)->with('members')->first();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * find room by token
     * @param string $token
     * @return mixed
     * 
     */
    public function findByToken(string $token) {
        try {
            return $this->room->where('token', $token)->first();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * member join room.
     * @return array
     */
    public function joinRoom(string $name, string $token) {
        try {
            $room = $this->findByToken($token);
            $room->join_member_count += 1;
            $room->save();
            $member = new Member([
                'name' => $name
            ]);
            $room->members()
                ->save($member);
            return ['room' => $room, 'member' => $member];
        } catch (\Exception $e) {   
            throw $e;
        }
    }

    /**
     * fetch users all rooms.
     * 
     */
    public function fetchUsersAllRooms(int $user_id)
    {
        try {
            return $this->room->where('user_id', $user_id)
                ->paginate();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * fetch all rooms
     * 
     */
    public function fetchAllRooms() {
        try {
            return $this->room->paginate(10);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * update room data.
     * 
     */
    public function updateRoom(Request $request) {
        try {
            $room = $this->findById($request->id);
            return $room->fill($request->all())->update();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * find by id
     * @param int $id
     * 
     */
    public function findById(int $id) {
        try {
            return $this->room->find($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * delete room data.
     * 
     */
    public function deleteRoom(int $id) {
        try {
            $room = $this->findById($id);
            return $room->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}