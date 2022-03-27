<?php

namespace Tests\Feature\Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Events\BadgeUnlocked;


class BadgeUnlockedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_event_constructor()
    {
        $badge_name = "Master";
        $user = User::factory()->create();
        $event = new BadgeUnlocked($badge_name, $user);

        $this->assertSame($badge_name, $event->badge_name);
        $this->assertSame($user, $event->user);
    }
}
