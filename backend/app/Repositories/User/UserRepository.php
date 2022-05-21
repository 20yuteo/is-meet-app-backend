<?php

namespace App\Repositories\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface {

    private $eloquent;

    /**
     * @param User $user
     * 
     */
    public function __construct(User $user)
    {
        $this->eloquent = $user;
    }

    /**
     * @param Object $payload
     * @return User $user
     */
    public function findByEmailAndPassword(Array $object) {
        return $this->eloquent->where('email', $object['email'])
            ->Where('password', Hash::make($object['password']))
                ->first();
    }

    /**
     * fetch all users.
     * 
     */
    public function fetchAllUsers() {
        return $this->eloquent->paginate(10);
    }

    /**
     * update user
     * @param int $id
     * @param Array $data
     * 
     */
    public function updateUser(int $id, Array $data) {
        try {
            $user = $this->findById($id);
            return $user->fill($data)->save();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * findById
     * @param int $id
     * 
     */
    public function findById(int $id) {
        return $this->eloquent->find($id);
    }

    /**
     * delete user
     * @param int $id
     * 
     */
    public function deleteUser(int $id) {
        try {
            $res = $this->findById($id);
            return $res->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}