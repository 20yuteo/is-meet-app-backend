<?php
namespace App\UseCase;

use App\Repositories\User\UserRepositoryInterface;

class User {
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function fetchAllUsers() {
        try {
            return $this->userRepository->fetchAllUsers();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function updateUser(int $id, Array $data) {
        try {
            return $this->userRepository->updateUser($id, $data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function deleteUser(int $id){
        try {
            return $this->userRepository->deleteUser($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}