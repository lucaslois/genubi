<?php

namespace Tests\Feature;

use App\Models\Character;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllCharacters()
    {
        $characters = Character::factory(5)
            ->for(User::factory()
            ->state([
                'name' => "Lucas Lois"
            ]))
            ->create();

        $response = $this->get('/api/characters');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }
}
