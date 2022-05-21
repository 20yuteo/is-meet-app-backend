<?php

namespace App\UseCase;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Services\Token;

class Room {

    private $room_repository;

    public function __construct(RoomRepositoryInterface $room_repository)
    {
        $this->room_repository = $room_repository;
    }

    /**
     * create new Room
     * @param User $user
     * @param Request $reqeust
     * 
     */
    public function createRoom(User $user, Request $request) {
        $token = Token::getToken();
        try {
            $res = $this->room_repository->create($user, array_merge($request->all(), ['token' => $token, 'invite_url' => config('app.spa_url') . '/call/room?name='. $request->name .'&token=' .$token, 'join_member_count' => 0]));
            if ($res) return $this->room_repository->findByName($request->name);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * find room by token
     * @param string $token
     * 
     */
    public function findByToken(string $token) {
        try {
            return $this->room_repository->findByToken($token);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * member join room.
     * @param string $name
     * @param string $token
     * 
     */
    public function joinRoom(string $name, string $token) {
        try {
            return $this->room_repository->joinRoom($name, $token);
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
            return $this->room_repository->fetchUsersAllRooms($user_id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * fetch all rooms.
     * 
     */
    public function fetchAllRooms() {
        try {
            return $this->room_repository->fetchAllRooms();
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
            return $this->room_repository->updateRoom($request);
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
            return $this->room_repository->deleteRoom($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}