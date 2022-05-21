<?php

namespace App\Services;

class Token {

    public static function getToken()
    {
        return uniqid(bin2hex(random_bytes(1)));
    }
}