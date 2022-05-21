<?php

namespace App\Http\Requests;

use App\Rules\Room\UpdateRoomName;
use App\Rules\Room\UpdateRoomToken;
use App\Rules\Room\UpdateRoomJoinMemberCount;
use App\Rules\Room\UpdateRoomInviteUrl;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', new UpdateRoomName($this->request->get('id'))],
            'token' => ['required', 'string', new UpdateRoomToken($this->request->get('id'))],
            'join_member_count' => ['required', 'integer',new UpdateRoomJoinMemberCount($this->request->get('id'))],
            'invite_url' => ['required', 'string', new UpdateRoomInviteUrl($this->request->get('id'))]
        ];
    }
}
