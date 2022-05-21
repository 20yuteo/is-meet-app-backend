<?php

namespace App\Domain\Member;

use App\Models\Member;

class MemberService {

    /**
     * check exist member name
     * @param string $name
     * @return boolean $result
     * 
     */
    public function checkExistsMemberName(string $name) {
        return !Member::where('name', $name)->exists();
    }
}