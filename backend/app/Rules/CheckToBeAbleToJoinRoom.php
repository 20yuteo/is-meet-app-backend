<?php

namespace App\Rules;

use App\Domain\Room\RoomEntity;
use App\Models\Room;
use App\Repositories\Room\RoomRepository;
use Illuminate\Contracts\Validation\Rule;

class CheckToBeAbleToJoinRoom implements Rule
{
    private $room_repository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->room_repository = new RoomRepository(new Room());
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** token で Room 情報を取得 */
        $res = $this->room_repository->findByToken($value);

        /** 存在しなければ false */
        if (!$res) return false;

        /** Room Entity を生成 */
        $room = new RoomEntity($res->name, $res->token, $res->invite_url, $res->join_member_count);

        /** memberが参加できるか check */
        return $room->checkJoinRoom();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'このRoomは参加上限に達しています。';
    }
}
