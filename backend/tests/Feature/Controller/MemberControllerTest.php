<?php

namespace Tests\Feature\Controller;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Room;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Room\RoomRepositoryInterface;

class MemberControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->admin()->create();
        $this->join_member = new User([
            'name' => 'join user',
            'email' => 'test@gmail.com',
            'password' => 'password'
        ]);
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
        $name = 'member name';
        $this->withoutExceptionHandling();
        $response = $this->postJson('/api/member', ['name' => $name, 'token' => $this->room->token]);
        $response->assertOk();
        $this->assertSame($name, $this->room->members()->first()->name);
    }

    /**
     * A test for store request with 422 error.
     * 
     * @return void
     */
    public function testStoreRequestWith422Error()
    {
        $response = $this->postJson('/api/member', [
            'name' => '',
            'token' => $this->room->token
        ]);

        $response->assertStatus(422);
    }

    /**
     * A test for store request with internal server error.
     * 
     * @return void
     */
    public function testStoreRequestWith500Error() {
        $this->withoutExceptionHandling();
        $name = 'test name';
        
        $mock = \Mockery::mock(RoomRepository::class);
        $mock->shouldReceive('joinRoom')
        ->once()
        ->andThrow(\Exception::class);
        
        $this->app->bind(RoomRepositoryInterface::class, function() use ($mock) {
            return $mock;
        });
        $this->expectException(\Exception::class);
        ($this->postJson('api/member', ['name' => $name, 'token' => $this->room->token]))->execute(1);
        $this->assertSame(0, Member::all()->count());
    }
}
