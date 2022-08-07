<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        return view('student.dashboard', [
            'student'=> student(Auth::id()),
            'placement' => student_placement(Auth::id())
        ]);
    }

    public function details()
    {
        return view('student.add-student-details');
    }

    public function add(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'regnum' => ['required', 'starts_with:R'],
            'phone' => ['required', 'digits:10', 'starts_with:07'],
            'program' => ['required', 'string']
        ]);

        $stud = new Student();
        $stud->user_id = Auth::id();
        $stud->firstname = $request->firstname;
        $stud->lastname = $request->lastname;
        $stud->regnum = $request->regnum;
        $stud->phone = $request->phone;
        $stud->program = $request->program;

        $stud->save();

        return redirect()->route('student-dashboard')->with('success', 'successfully added student details');
    }
}
