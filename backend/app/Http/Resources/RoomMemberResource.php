<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['room']->id,
            'name' => $this['room']->name,
            'token' => $this['room']->token,
            'invite_url' => $this['room']->invite_url,
            'join_member_count' => $this['room']->join_member_count,
            'member_id' => $this['member']->id
        ];
    }
}
