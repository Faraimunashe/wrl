<?php

use App\Models\Chat;
use App\Models\Placement;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function student($user_id){
    $student = Student::where('user_id', $user_id)->first();
    if(is_null($student))
    {
        return null;
    }else{
        return $student;
    }
}

function my_students(){
    $placement = Placement::join('students', 'students.id', '=', 'placements.student_id')
        ->where('placements.supervisor_id', supervisor(Auth::id())->id)
        ->select('students.id', 'students.firstname', 'students.lastname', 'students.regnum', 'students.phone')
        ->get();
    return $placement;
}

function supervisor($user_id){
    $supervisor = Supervisor::where('user_id', $user_id)->first();
    if(is_null($supervisor))
    {
        return null;
    }else{
        return $supervisor;
    }
}

function my_supervisor($id){
    $supervisor = Supervisor::find($id);
    if(is_null($supervisor))
    {
        return null;
    }else{
        return $supervisor;
    }
}

function supervisors(){
    $supervisor = Supervisor::all();

    return $supervisor;
}

function student_placement($user_id){
    $student = Student::where('user_id', $user_id)->first();
    if(is_null($student)){
        return null;
    }
    $placement = Placement::where('student_id', $student->id)->first();
    if(is_null($placement)){
        return null;
    }

    return $placement;
}

function supervisor_placement($user_id){
    $supervisor = Supervisor::where('user_id', $user_id)->first();
    if(is_null($supervisor)){
        return null;
    }
    $placement = Placement::where('supervisor_id', $supervisor->id)->first();
    if(is_null($placement)){
        return null;
    }

    return $placement;
}

function chat_name($user_id){
    $user = User::find($user_id);
    if(is_null($user)){
        return null;
    }
    return $user;
}

function diff_in_time($date1, $date2)
{
    if($date1->diffInDays($date2) == 0){
        if($date1->diffInHours($date2)==0){
            if($date1->diffInMinutes($date2)==0){
                return $date1->diffInSeconds($date2)." secs";
            }else{
                return $date1->diffInMinutes($date2)." mins";
            }
        }else{
            return $date1->diffInHours($date2)." hrs";
        }
    }else{
        return $date1->diffInDays($date2)." days";
    }

}

function last_msg($convo_id){
    $msg = Chat::where('conver_id', $convo_id)->latest()->first();
    if(is_null($msg)){
        return "new";
    }
     return substr($msg->message,0,15).'...';
}
