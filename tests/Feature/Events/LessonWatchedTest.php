<?php

namespace Tests\Feature\Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Lesson;
use App\Events\LessonWatched;
class LessonWatchedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_event_constructor()
    {
        $lesson = Lesson::factory()->create();
        $user = User::factory()->create();
        $event = new LessonWatched($lesson, $user);

        $this->assertSame($lesson, $event->lesson);
        $this->assertSame($user, $event->user);
    }
}
