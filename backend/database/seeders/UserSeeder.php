<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->admin()
            ->has(Room::factory()->count(3))->create();

        User::factory()
            ->has(Room::factory()->count(5))->count(10)->create();
    }
}
