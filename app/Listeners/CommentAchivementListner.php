<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AchievementUnlocked;
class CommentAchivementListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user_comments=$event->user->comments->count();
        $achievement_name='';
        $comments_written_achivement_config = config('constants.comments_written_achivement');
        for($i=1; $i<=count($comments_written_achivement_config); $i++)
        {
            if($user_comments == $comments_written_achivement_config[$i]['start'])
            {
                $achievement_name = $comments_written_achivement_config[$i]['name'];
            }

        }
        if($achievement_name)
        {
            AchievementUnlocked::dispatch($achievement_name,$event->user);
        }
    }
}
