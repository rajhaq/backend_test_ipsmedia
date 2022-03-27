<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Lesson;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $unlocked_achievements = array();
        $next_available_achievements = array();
        $number_of_achievements = 0;
        //comments achivemnt 
        $user_comments=$user->comments->count();
        $comments_written_achivement_config = config('constants.comments_written_achivement');

        if($user_comments==0)
        {
            array_push($next_available_achievements,$comments_written_achivement_config[1]['name']);            
        }
        else 
        {
            for($i=1; $i<=count($comments_written_achivement_config); $i++)
            {
                $number_of_achievements++;
                if($user_comments >= $comments_written_achivement_config[$i]['start'] && $user_comments < $comments_written_achivement_config[$i+1]['start'])
                {
                    array_push($unlocked_achievements, $comments_written_achivement_config[$i]['name']);        
                    if($i!=count($comments_written_achivement_config))
                    {
                        array_push($next_available_achievements, $comments_written_achivement_config[$i+1]['name']);
                    } 
                    break;
                }
    
            }    
        }
        //lesson achivemnt 
        $user_lesson_watched=$user->watched->count();
        $lesson_config = config('constants.lesson');
        if($user_lesson_watched==0)
        {
            array_push($next_available_achievements,$lesson_config[1]['name']);            
        }
        else 
        {
            for($i=1; $i<=count($lesson_config); $i++)
            {

                $number_of_achievements++;
                if($user_comments >= $lesson_config[$i]['start'] && $user_comments < $lesson_config[$i+1]['start'])
                {
                    array_push($unlocked_achievements, $lesson_config[$i]['name']);
                    if($i!=count($lesson_config))
                    {            
                        array_push($next_available_achievements, $lesson_config[$i+1]['name']);
                    }
                    break;
                }
    
            }    
        }
        // badge
        $current_badge="";
        $next_badge="";
        $badges_config = config('constants.badges');
        $remaing_to_unlock_next_badge = 0;
        // dd($badges_config[$i+1]['start'].' - '.$number_of_achievements);
        for($i=1; $i<=count($badges_config); $i++)
            {
                if($i==count($badges_config) && $number_of_achievements>=$badges_config[$i]['start'])
                {
                    $current_badge=$badges_config[$i]['name'];
                    $next_badge='';
                    $remaing_to_unlock_next_badge = 0;
                }
                else if($badges_config[$i]['start']<=$number_of_achievements)
                {
                    $current_badge=$badges_config[$i]['name'];
                    $next_badge=$badges_config[$i+1]['name'];
                    $remaing_to_unlock_next_badge = $badges_config[$i+1]['start'] - $number_of_achievements;

                }    
            }   

        return response()->json([
            'unlocked_achievements' => $unlocked_achievements,
            'next_available_achievements' => $next_available_achievements,
            'current_badge' => $current_badge,
            'next_badge' => $next_badge,
            'remaing_to_unlock_next_badge' => $remaing_to_unlock_next_badge
        ]);
    }

}
