<?php

namespace App\Http\Controllers;

use App\Helpers\Logs;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::all();
        $facuties = Faculty::all();

        return view('departments.index', [
            'departments' => $departments,
            'faculties' => $facuties,
        ]);
    }

    public function store(Request $request)
    {
        $existtingDepartment = Department::where('name', $request->department_name)->first();

        if ($existtingDepartment) {
            return response()->json(['success' => true, 'message' => 'Similar department already exist']);
        }

        $department = [
            'name' => $request->department_name,
            'faculty_id' => $request->department_head,
        ];

        $savedDepartment = Department::create($department);

        if (!is_null($savedDepartment)) {
            Logs::addToLog('A department has been added | DEPARTMENT [' . $savedDepartment->name . ']');
            return response()->json(['success' => true, 'message' => 'New department has been created!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful!']);
        }
    }

    public function getDepartment($id) {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $existtingDepartment = Department::where('name', $request->department_name)->first();

        if ($existtingDepartment) {
            return response()->json(['success' => true, 'message' => 'Similar department already exist']);
        }

        $editDepartment = [
            'name' => $request->edit_department_name,
            'faculty_id' => $request->edit_department_head,
        ];

        $department->update($editDepartment);

        if ($department->wasChanged()) {
            Logs::addToLog('A department has been updated to [' . $department->name . '] [' . $department->faculty_id . ']');
            return response()->json(['success' => true, 'message' => 'The dpartment has been updated!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Nothing was changed']);
        }
    }

    public function delete($id)
    {
        $department = Department::find($id);
        if ($department->delete()) {
            Logs::addToLog('A department has been deleted | DEPARTMENT [' . $department->name . ']');
            return response()->json(['success' => true, 'message' => 'Department deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Department not found.']);
        }
    }
}
