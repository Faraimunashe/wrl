<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('student')){
            if(is_null(student(Auth::id()))){
                return redirect()->route('student-details')->with('error', 'Add student details first');
            }
            return redirect()->route('student-dashboard');
        }elseif(Auth::user()->hasRole('supervisor')){
            if(is_null(supervisor(Auth::id()))){
                return redirect()->route('supervisor-details')->with('error', 'Add student details first');
            }
            return redirect()->route('supervisor-dashboard');
        }
    }
}
