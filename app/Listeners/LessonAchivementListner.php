<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AchievementUnlocked;


class LessonAchivementListner
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
        $user_lesson_watched=$event->user->watched->count();
        $achievement_name='';
        $lesson_config = config('constants.lesson');
        for($i=1; $i<=count($lesson_config); $i++)
        {
            if($user_lesson_watched== $lesson_config[$i]['start'])
            {
                $achievement_name = $lesson_config[$i]['name'];
            }

        }
        
        if($achievement_name)
        {
        AchievementUnlocked::dispatch($achievement_name,$event->user);
        }
    }
}
