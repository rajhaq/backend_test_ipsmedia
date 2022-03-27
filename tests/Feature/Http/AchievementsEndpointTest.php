<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;

class AchievementsEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    public function test_retrun_value_structure()
    {
        
        $response = $this->get("/users/{$this->user->id}/achievements");

        $response->assertStatus(200)
        ->assertJsonStructure([
                "unlocked_achievements" => [],
                "next_available_achievements" => [],
                "current_badge",
                "next_badge",
                "remaing_to_unlock_next_badge"
                
        ]);
    }
    public function test_first_achivement()
    {
        Comment::factory()->create();
        $response = $this->get("/users/{$this->user->id}/achievements");

        $response->assertStatus(200)
        ->assertJsonStructure([
                "unlocked_achievements",
                "next_available_achievements",
                "current_badge",
                "next_badge",
                "remaing_to_unlock_next_badge"
                
        ]);
    }
    public function test_few_achivement()
    {
        Comment::factory()->count(3)->create([
            'user_id' => $this->user->id
        ]);
        $response = $this->get("/users/{$this->user->id}/achievements");

        $response->assertStatus(200)
        ->assertJsonStructure([
                "unlocked_achievements",
                "next_available_achievements",
                "current_badge",
                "next_badge",
                "remaing_to_unlock_next_badge"
                
        ]);
    }
    public function test_many_achivement()
    {
        Comment::factory()->count(10)->create([
            'user_id' => $this->user->id
        ]);
        $response = $this->get("/users/{$this->user->id}/achievements");

        $response->assertStatus(200)
        ->assertJsonStructure([
                "unlocked_achievements",
                "next_available_achievements",
                "current_badge",
                "next_badge",
                "remaing_to_unlock_next_badge"
                
        ]);
    }
}
