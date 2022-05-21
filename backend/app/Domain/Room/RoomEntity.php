<?php

namespace App\Domain\Room;

use App\Models\Room;

class RoomEntity {
    protected $name;

    protected $token;

    protected $invite_url;

    protected $join_member_count;

    public function __construct(string $name, string $token, string $invite_url, ?int $join_member_count = 0)
    {
        $this->name = $name;

        $this->token = $token;

        $this->invite_url = $invite_url;

        $this->join_member_count = $join_member_count;

    }

    /**
     * check member is able to join this room.
     * @return boolean
     * 
     */
    public function checkJoinRoom() {
        return $this->join_member_count < 10;
    }

    /**
     * get maximum join member!
     * 
     */
    public function getMaximumJoinMember() {
        return 10;
    }
}