<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Logs;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FacultyController extends Controller
{
    public function index() {

        $faculties = Faculty::where('is_archived', false)->filter(Request(['search']))->get();

        $departments = Department::all();

        return view('faculty.index', [
            'faculties' => $faculties,
            'departments' => $departments,
        ]);
    }

    public function show(Faculty $faculty) {

        $departments = Department::all();

        return view('faculty.show', [
            'faculty' => $faculty,
            'departments' => $departments,
        ]);
    }

    public function store(Request $request) {

        $existingEmail = Faculty::where('email', $request->email)->where('is_archived', false)->first();

        if ($existingEmail) {
            return response()->json(['success' => false, 'message' => 'The email is already assigned to another faculty member']);
        }

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $faculty = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'suffix' => $request->suffix,
            'sex' => $request->sex,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'department_id' => $request->department,
            'school_year_id' => $current_school_year->id,
        ];

        $facultySaved = Faculty::create($faculty);

        $facultyAccount = [
            'name' => $request->first_name . " " . $request->last_name . " " . $request->middle_name,
            'email' => $request->email,
            'username' => $request->email,
            'password' => Hash::make($request->last_name),
            'type' => 'faculty',
        ];

        $accountSaved = User::create($facultyAccount);

        if (!is_null($facultySaved) && !is_null($accountSaved)) {
            Logs::addToLog('New faculty has been added to the list | EMAIL [' . $accountSaved->email . ']');
            return response()->json(['success' => true, 'message' => 'Faculty has been saved!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful!']);
        }
    }

    public function update(Request $request, $id) {
        $currentFaculty = Faculty::find($id);

        $currentAccount = User::where('email', $currentFaculty->email)->where('status', 'active')->first();

        // if (is_null($currentAccount)) {
        //     return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        // }

        $existingEmail = Faculty::where('email', $request->email)->where('id', '!=', $id)->where('is_archived', false)->first();

        if ($existingEmail) {
            return response()->json(['success' => false, 'message' => 'The email is already assigned to another faculty member']);
        }

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $faculty = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'suffix' => $request->suffix,
            'sex' => $request->sex,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'department_id' => $request->department,
            'school_year_id' => $current_school_year->id,
        ];

        $facultyAccount = [
            'name' => $request->first_name . " " . $request->last_name . " " . $request->middle_name,
            'email' => $request->email,
            'username' => $request->email,
            'password' => Hash::make($request->last_name),
            'type' => 'faculty',
        ];

        $currentFaculty->update($faculty);

        // $currentAccount->update($facultyAccount);

        if ($currentFaculty->wasChanged()) {
            Logs::addToLog('A faculty member information has been updated | EMAIL [' . $currentFaculty->email . ']');
            return response()->json(['success' => true, 'message' => 'Faculty has been updated']);
        } else {
            return response()->json(['success' => false, 'message' => 'Nothing was changed']);
        }
    }

    public function delete($id) {
        $faculty = Faculty::find($id);
        if ($faculty) {
            $faculty->is_archived = true;
            $faculty->save();
            Logs::addToLog('A faculty member has been moved to archive | EMAIL [' . $faculty->email . ']');
            return response()->json(['success' => true, 'message' => 'Faculty deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Faculty not found.']);
        }
    }

    public function dashboard() {
        return view('faculty.dashboard');
    }
}
