<?php

namespace App\Rules\Room;

use App\Domain\Room\RoomService;
use Illuminate\Contracts\Validation\Rule;

class UpdateRoomName implements Rule
{
    private $room_service;

    private $room_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $room_id)
    {
        $this->room_service = new RoomService;
        $this->room_id = $room_id;
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
        return $this->room_service->checkToBeAbleToUpdateRoomName($this->room_id, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'このルーム名には更新できません。';
    }
}
