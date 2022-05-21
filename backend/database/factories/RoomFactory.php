<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Services\Token;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'token' => Token::getToken(),
            'invite_url' => config('app.spa_url') . '/call/room?name='. $this->faker->name() .'&token=' .Token::getToken(),
            'join_member_count' => 0,
            'created_at' => now()
        ];
    }
}
