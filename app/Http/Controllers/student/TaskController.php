<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('student_id', student(Auth::id())->id)->get();

        return view('student.tasks', [
            'tasks' => $tasks
        ]);
    }
}
