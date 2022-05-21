<?php

namespace App\Repositories\Admin;

interface AdminRepositoryInterface {
    /**
     * find Admin User by email and password.
     * @param string $email
     * @param string password
     * 
     */
    public function findByEmail(string $email);
}
