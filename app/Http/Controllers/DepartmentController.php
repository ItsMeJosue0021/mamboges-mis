<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::where('is_archived', false)->get();

        $facuties = Faculty::where('is_archived', false)->get();

        return view('departments.index', [
            'departments' => $departments,
            'faculties' => $facuties,
        ]);
    }

    public function store(Request $request)
    {
        $existtingDepartment = Department::where('department_name', $request->department_name)->first();

        if ($existtingDepartment) {
            return response()->json(['success' => true, 'message' => 'Similar department already exist']);
        }

        $department = [
            'department_name' => $request->department_name,
            'department_head' => $request->department_head,
        ];

        $savedDepartment = Department::create($department);

        if (!is_null($savedDepartment)) {
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

        $existtingDepartment = Department::where('department_name', $request->department_name)->first();

        if ($existtingDepartment) {
            return response()->json(['success' => true, 'message' => 'Similar department already exist']);
        }

        $editDepartment = [
            'department_name' => $request->edit_department_name,
            'department_head' => $request->edit_department_head,
        ];

        $department->update($editDepartment);

        if ($department->wasChanged()) {
            return response()->json(['success' => true, 'message' => 'The dpartment has been updated!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Nothing was changed']);
        }
    }

    public function delete($id)
    {
        $department = Department::find($id);
        if ($department) {
            $department->is_archived = true;
            $department->save();
            return response()->json(['success' => true, 'message' => 'Section deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Section not found.']);
        }
    }
}
