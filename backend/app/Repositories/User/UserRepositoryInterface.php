<?php

namespace App\Repositories\User;

interface UserRepositoryInterface {

    /**
     * @param Object $payload
     * 
     */
    public function findByEmailAndPassword(Array $payload);

    /**
     * fetch all users.
     * 
     */
    public function fetchAllUsers();

    /**
     * update user
     * @param int $id
     * @param Array $data!
     * 
     */
    public function updateUser(int $id, Array $data);

    /**
     * findById
     * @param int $id
     * 
     */
    public function findById(int $id);

    /**
     * delete user
     * @param int $id
     * 
     */
    public function deleteUser(int $id);
}