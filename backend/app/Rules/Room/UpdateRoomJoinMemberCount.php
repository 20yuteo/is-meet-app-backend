<?php

namespace App\Rules\Room;

use Illuminate\Contracts\Validation\Rule;
use App\Domain\Room\RoomEntity;
use App\Models\Room;
use App\Domain\Room\RoomService;

class UpdateRoomJoinMemberCount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->room_service = new RoomService();
        $room = Room::find($id);
        $this->room_entity = new RoomEntity(
            $room->name,
            $room->token,
            $room->invite_url,
            $room->join_member_url
        );
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
        clock($value < $this->room_entity->getMaximumJoinMember());
        return $value < $this->room_entity->getMaximumJoinMember();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ルームへの参加人数は10人以下にしてください。';
    }
}
