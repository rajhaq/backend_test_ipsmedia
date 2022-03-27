<?php

namespace Tests\Feature\Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;

use App\Events\CommentWritten;
class CommentWrittenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_event_constructor()
    {
        $comment = Comment::factory()->create();
        $event = new CommentWritten($comment);

        $this->assertSame($comment, $event->comment);
    }
}
