<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Room\RoomRepositoryInterface;

class RoomControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->admin()->create();
        $this->room = new Room();
        $this->user->rooms()->save($this->room->fill(
            [
                'name' => 'test room',
                'token' => 'token',
                'invite_url' => 'test url',
                'join_member_count' => 0
            ]
        ));
    }

    /**
     * A test for store request.
     *
     * @return void
     */
    public function testStoreRequest()
    {
        $name = 'room name';
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)
            ->postJson('/api/room/' . $this->user->id, ['name' => $name]);
        $response->assertOk();
        $this->assertCount(1, Room::where('name', $name)->get());
        $this->assertCount(2, Room::all());
    }

    /**
     * A test for store request with 401 error.
     *
     * @return void
     */
    public function testStoreRequestWith401Error()
    {
        $name = 'room name';
        $response = $this->postJson('/api/room/' . $this->user->id,
            ['name' => $name]
        );
        $response->assertStatus(401);
    }

    /**
     * A test for store request with 422 status.
     * 
     * @return void
     */
    public function testStoreRequestWith422Status()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/room/' . $this->user->id, ['name' => '']);

        $response->assertStatus(422);

        $this->assertCount(1, Room::all());
    }

    /**
     * A test for store request with 500 error.
     * 
     * @return void
     */
    public function testStoreRequestWith500Error()
    {
        $this->withoutExceptionHandling();
        $name = 'room name';
        $mock = \Mockery::mock(RoomRepository::class);
        $mock->shouldReceive('create')
        ->once()
        ->andThrow(\Exception::class);
        
        $this->app->bind(RoomRepositoryInterface::class, function() use ($mock) {
            return $mock;
        });

        $this->expectException(\Exception::class);
        ($this->actingAs($this->user)->postJson('/api/room/' . $this->user->id, ['name' => $name]))->execute(1);
        $this->assertCount(1, Room::all());
    }

    /**
     * A test for show request.
     * 
     * @return void
     */
    public function testShowRequest()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)
            ->getJson('/api/room/?token=' . $this->room->token);
        $response->assertOk();
    }

    /**
     * A test for show request with 401 error.
     * 
     * @return void
     */
    public function testShowRequestWith401Error()
    {
        $response = $this->getJson('/api/room/?token=' . $this->room->token);
        $response->assertStatus(401);
    }

    /**
     * A test for show request with 422 error.
     * 
     * @return void
     */
    public function testShowRequestWith422Error()
    {
        $response = $this->actingAs($this->user)
            ->getJson('/api/room');
        $response->assertStatus(422);
    }

    /**
     * A test for show request with 500 error.
     * 
     * @return void
     */
    public function testShowRequestWith500Error()
    {
        $this->withoutExceptionHandling();
        $name = 'room name';
        $mock = \Mockery::mock(RoomRepository::class);
        $mock->shouldReceive('findByToken')
            ->once()
            ->andThrow(\Exception::class);

        $this->app->bind(RoomRepositoryInterface::class, function() use ($mock) {
            return $mock;
        });

        $this->expectException(\Exception::class);
        ($this->actingAs($this->user)->getJson('/api/room/?token=' . $this->room->token))->execute(1);
    }

    /**
     * A test for index request.
     * 
     * @return void
     */
    public function testIndexRequest()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)
            ->getJson('/api/room/' . $this->user->id);

        $response->assertOk()
            ->assertJson([
                'data' => [
                    [
                        "id" => $this->room->id,
                        "name" => $this->room->name,
                        "token" => $this->room->token,
                        "invite_url" => $this->room->invite_url,
                        "join_member_count" => $this->room->join_member_count
                    ]
                ],
            ]);
    }

    /**
     * A test for index request with 401 error.
     * 
     * @return void
     */
    public function testIndexRequestWith401Error()
    {
        $response = $this->getJson('/api/room/' . $this->user->id);
        $response->assertStatus(401);
    }

    /**
     * A test for index request with 422 error.
     * 
     * @return void
     */
    public function testIndexRequestWith422Error()
    {
        $response = $this->actingAs($this->user)
            ->getJson('/api/room/');
        $response->assertStatus(422);
    }

    /**
     * A test for index request with 500 error.
     * 
     * @return void
     */
    public function testIndexRequestWith500Error()
    {
        $this->withoutExceptionHandling();

        $mock = \Mockery::mock(RoomRepository::class);
        $mock->shouldReceive('fetchUsersAllRooms')
            ->once()
            ->andThrow(\Exception::class);

        $this->app->bind(RoomRepositoryInterface::class, function() use ($mock) {
            return $mock;
        });

        $this->expectException(\Exception::class);
        ($this->actingAs($this->user)
            ->getJson('/api/room/' . $this->user->id))->execute(1);
    }
}
