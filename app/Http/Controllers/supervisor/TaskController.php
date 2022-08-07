<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Student;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::join('students', 'students.id', '=', 'tasks.student_id')
            ->where('tasks.supervisor_id', supervisor(Auth::id())->id)
            //->where('tasks.done', false)
            ->select('tasks.id', 'tasks.task', 'tasks.description', 'tasks.done', 'students.firstname', 'students.lastname')
            ->orderBy('tasks.created_at', 'DESC')
            ->get();

        return view('supervisor.tasks', [
            'tasks' => $tasks
        ]);
    }

    public function user_task($student_id)
    {
        $student = Student::find($student_id);
        if(is_null($student)){
            return redirect()->back()->with('error', 'could not find specified user');
        }

        return view('supervisor.assign-user-task', [
            'student' => $student
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'numeric'],
            'task' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        $student = Student::find($request->student_id);
        if(is_null($student)){
            return redirect()->back()->with('error', 'could not find specified user');
        }

        $task = new Task();
        $task->supervisor_id = supervisor(Auth::id())->id;
        $task->student_id = $request->student_id;
        $task->task = $request->task;
        $task->description = $request->description;

        $task->save();

        return redirect()->back()->with('success', 'Successfully assigned task');
    }

    public function approve($task_id)
    {
        $task = Task::find($task_id);

        $book = new Logbook();
        $book->student_id = $task->student_id;
        $book->task = $task->task;
        $book->description = $task->description;
        $book->save();

        $task->done = true;
        $task->save();

        return redirect()->back()->with('success', 'successfully upated task');
    }
}
