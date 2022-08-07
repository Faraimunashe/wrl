<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Student;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index($student_id)
    {
        $logbook = Logbook::where('student_id', $student_id)->get();
        $student = Student::find($student_id);

        return view('supervisor.logbook', [
            'logbook' => $logbook,
            'student' => $student
        ]);
    }
}
