<?php

namespace App\Domain\Room;

use App\Models\Room;

class RoomService {

    /**
     * check room exists by name.
     * @param string $name
     * @return bool
     */
    public function existByName(string $name) {
        return Room::where('name', $name)->exists();
    }

    /**
     * check room exists by token.
     * @param string $token
     * @return bool
     * 
     */
    public function existsByToken(string $token) {
        return Room::where('token', $token)->exists();
    }

    /**
     * check to be able to update room name.
     * 
     */
    public function checkToBeAbleToUpdateRoomName(int $id, string $name) {
        $room = Room::find($id);
        return !$room->name === $name || Room::where('name', $name)->exists();
    }

    /**
     * check to be able to update room token.
     * 
     */
    public function checkToBeAbleToUpdateRoomToken(int $id, string $token) {
        $room = Room::find($id);
        return !$room->token === $token || Room::where('token', $token)->exists();
    }

    /**
     * check to be able to update room invite url.
     * 
     */
    public function checkToBeAbleToUpdateRoomInviteUrl (int $id, string $invite_url) {
        $room = Room::find($id);
        return !$room->invite_url === $invite_url || Room::where('invite_url', $invite_url)->exists();
    }
}