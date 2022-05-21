<?php

namespace App\Rules;

use App\Domain\Room\RoomService;
use Illuminate\Contracts\Validation\Rule;

class UniqueRoomName implements Rule
{
    private $room_service;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->room_service = new RoomService();
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
        return !$this->room_service->existByName($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'このRoom名は既に登録されています。';
    }
}
