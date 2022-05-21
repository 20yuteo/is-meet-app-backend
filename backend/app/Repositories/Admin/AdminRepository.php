<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Repositories\Admin\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface {

    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * find Admin User by email and password.
     * 
     * 
     */
    public function findByEmail(string $email) {
        try {
            return $this->admin->where('email', $email)->first();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
