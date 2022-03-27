<?php

namespace Tests\Feature\Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Events\AchievementUnlocked;
class AchivementUnlockedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_event_constructor()
    {
        $achievement_name = "First Comment Achived";
        $user = User::factory()->create();
        $event = new AchievementUnlocked($achievement_name, $user);

        $this->assertSame($achievement_name, $event->achievement_name);
        $this->assertSame($user, $event->user);
    }
}
