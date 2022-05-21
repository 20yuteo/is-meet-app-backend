<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ExistsRoomWithToken;
use App\Rules\CheckToBeAbleToJoinRoom;
use App\Rules\UniqueMemberName;

class JoinRoomRequest extends FormRequest
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
            'token' => ['required', 'string', new ExistsRoomWithToken, new CheckToBeAbleToJoinRoom],
            'name' => ['required', 'string', 'max:255', new UniqueMemberName]
        ];
    }
}
