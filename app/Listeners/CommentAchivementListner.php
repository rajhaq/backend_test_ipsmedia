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
        // dd($event->user->comments->count());
        $user_comments=$event->user->comments->count();
        $achievement_name='';
        
        if($user_comments==1)
        {
            $achievement_name = "First Comment Written";

        }
        else if($user_comments==3)
        {
            $achievement_name = "3 Comments Written";

        }
        else if($user_comments==5)
        {
            $achievement_name = "5 Comments Written";
            
        }
        else if($user_comments==10)
        {
            $achievement_name = "10 Comments Written";
        }
        else if($user_comments==20)
        {
            $achievement_name = "20 Comments Written";            
        }
        if($achievement_name)
        {
            AchievementUnlocked::dispatch($achievement_name,$event->user);
        }
    }
}
