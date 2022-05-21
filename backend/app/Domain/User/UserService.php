<?php

namespace App\Domain\User;

use App\Models\User;

class UserService {

    /**
     * check to be updatable email.
     * @param string email
     * 
     */
    public function checkToBeAbleToUpdateEmail(int $id, string $email) {
        clock(!User::where('email', $email)->exists());
        clock(User::find($id)->email === $email);
        return User::find($id)->email === $email || !User::where('email', $email)->exists();
    }
}