<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogBookController extends Controller
{
    public function index()
    {
        $logbook = Logbook::where('student_id', student(Auth::id())->id)->get();
        return view('student.logbook', [
            'logbook' => $logbook
        ]);
    }

    public function book()
    {
        return view('student.add-logbook');
    }

    public function add(Request $request)
    {
        $request->validate([
            'task' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        $book = new Logbook();
        $book->student_id = student(Auth::id())->id;
        $book->task = $request->task;
        $book->description = $request->description;

        $book->save();

        return redirect()->back()->with('success', 'you have successfully inserted into log book');
    }
}
