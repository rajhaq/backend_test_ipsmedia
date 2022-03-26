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
        
        if($user_lesson_watched==1)
        {
            $achievement_name = "First Lesson Watched";

        }
        else if($user_lesson_watched==5)
        {
            $achievement_name = "5 Lessons Watched";

        }
        else if($user_lesson_watched==10)
        {
            $achievement_name = "10 Lessons Watched";
            
        }
        else if($user_lesson_watched==25)
        {
            $achievement_name = "25 Lessons Watched";
        }
        else if($user_lesson_watched==50)
        {
            $achievement_name = "50 Lessons Watched";            
        }
        if($achievement_name)
        {
        AchievementUnlocked::dispatch($achievement_name,$event->user);
        }
    }
}
