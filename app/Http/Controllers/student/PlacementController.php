<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Placement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlacementController extends Controller
{
    public function index()
    {
        $placement = student_placement(Auth::id());
        if(is_null($placement)){
            return redirect()->route('student-placement-details')->with('error', 'You have no placement registration');
        }

        return view('student.placement', [
            'placement' => $placement
        ]);
    }

    public function details()
    {
        $placement = student_placement(Auth::id());
        if(!is_null($placement)){
            return redirect()->route('student-placement')->with('error', 'You already registered a placement');
        }

        return view('student.placement-form');
    }

    public function add(Request $request)
    {
        $request->validate([
            'supervisor_id' => ['required', 'numeric'],
            'engagement' => ['required', 'date'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'digits:10'],
            'address' => ['required', 'string']
        ]);

        if(!is_null(Placement::where('student_id', Auth::id())->first())){
            return redirect()->back()->with('error', 'Student already registered in another placement');
        }

        $place = new Placement();
        $place->supervisor_id = $request->supervisor_id;
        $place->student_id = student(Auth::id())->id;
        $place->engagement = $request->engagement;
        $place->company_name = $request->name;
        $place->company_phone = $request->phone;
        $place->company_address = $request->address;

        $place->save();

        return redirect()->route('student-dashboard')->with('success', 'You have successfully registered placement details');
    }
}
