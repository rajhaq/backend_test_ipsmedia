<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BadgeUnlocked;


class AchivementListner
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
        $total_achivement = 0;

        $user_comments=$event->user->comments->count();
        $user_lesson_watched=$event->user->watched->count();

        $lesson_config = config('constants.lesson');
        $comments_written_achivement_config = config('constants.comments_written_achivement');
        $badges_config = config('constants.badges');

        for($i=1; $i<=count($comments_written_achivement_config); $i++)
        {
            if($user_comments <= $comments_written_achivement_config[$i]['start'])
            {
                $total_achivement++;
            }

        }

        for($i=1; $i<=count($lesson_config); $i++)
        {
            if($user_lesson_watched <= $lesson_config[$i]['start'])
            {
                $total_achivement++;
            }

        }

        for($i=1; $i<=count($badges_config); $i++)
        {
            if($total_achivement == $badges_config[$i]['start'])
            {
                BadgeUnlocked::dispatch($badges_config[$i]['name'],$event->user);
                break;
            }
            

        }
    }
}
