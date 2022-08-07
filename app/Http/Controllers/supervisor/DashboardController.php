<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('supervisor.dashboard');
    }

    public function details()
    {
        return view('supervisor.add-supervisor-details');
    }

    public function add(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'digits:10', 'starts_with:07'],
            'designation' => ['required', 'string']
        ]);

        $sup = new Supervisor();
        $sup->user_id = Auth::id();
        $sup->firstname = $request->firstname;
        $sup->lastname = $request->lastname;
        $sup->email = $request->email;
        $sup->phone = $request->phone;
        $sup->designation = $request->designation;

        $sup->save();

        return redirect()->route('supervisor-dashboard')->with('success', 'successfully added supervisor details');
    }
}
