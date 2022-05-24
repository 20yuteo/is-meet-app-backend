<?php

namespace App\Domain\Member;

use App\Models\Member;
use App\Models\Room;

class MemberService {

    /**
     * check exist member name
     * @param string $name
     * @return boolean $result
     * 
     */
    public function checkExistsMemberName(string $token, string $name) {
        return !Room::where('token', $token)->first()->members()->where('name', $name)->exists();
    }
}