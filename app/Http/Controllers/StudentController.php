<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index() {

        $students = Student::orderBy('grade_level')->filter(Request(['search']))->where('is_archived', false)->get();

        $sections = Section::where('is_archived', false)->get();

        return view('student.index', [
            'students' => $students,
            'sections' => $sections,
        ]);
    }

    public function show(Student $student) {

        $section = Section::where('id', $student->section_id)->where('is_archived', false)->first();

        $parent = Guardian::where('id', $student->parent_id)->first();
        
        return view('student.show', [
            'student' => $student,
            'section' => $section,
            'parent' => $parent,
        ]);
    }

    public function dashboard() {
        return view('student.dashboard');
    }

    public function store(Request $request) {

        $existingStudent = Student::where('lrn', $request->lrn)->where('is_archived', false)->first();

        if ($existingStudent) {
            return response()->json(['success' => false, 'message' => 'LRN is already assigned to another student']);
        }

        $existingEmail = Guardian::where('email', $request->email)->first();

        if ($existingEmail) {
            return response()->json(['success' => false, 'message' => 'The same email is alredy registered']);
        }

        $studentGuardian = [
            'first_name' => $request->parent_first_name,
            'last_name' => $request->parent_last_name,
            'middle_name' => $request->parent_middle_name,
            'suffix' => $request->parent_suffix,
            'sex' => $request->parent_sex,
            'email' => $request->email,
            'contact_no' => $request->parent_contact_no,
            'address' => $request->address,
        ];

        $guardian = Guardian::create($studentGuardian);

        $current_school_year = SchoolYear::where('is_current', true)->first();

        if (!is_null($guardian)) {
            $studentArray = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'suffix' => $request->suffix,
                'sex' => $request->sex,
                'lrn' => $request->lrn,
                'dob' => $request->dob,
                'address' => $request->address,
                'grade_level' => $request->grade_level,
                'parent_id' => $guardian->id,
                'school_year_id' => $current_school_year->id
            ];
    
            $studentAccount = [
                'name' => $request->first_name . " " . $request->last_name . " " . $request->middle_name,
                'username' => $request->lrn,
                'password' => Hash::make($request->lrn),
            ];
        
            $student = Student::create($studentArray);
            
            $account = User::create($studentAccount);

            if (!is_null($student) && !is_null($account)) {
                return response()->json(['success' => true, 'message' => 'Student has been saved!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Saving unsuccessful!']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful, please check the details of Guirdian.']);
        }  

    }

    public function update(Request $request, $id) {
        $student = Student::find($id);
        $guardian = Guardian::find($student->parent_id);
    
        if(!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    
        $lrn = $request->lrn;
        $existingStudent = Student::where('lrn', $lrn)->where('id', '!=', $id)->where('is_archived', false)->first();
    
        if ($existingStudent) {
            return response()->json(['success' => false, 'message' => 'LRN is already assigned to another student']);
        }
    
        $email = $request->email;
        $existingEmail = Guardian::where('email', $email)
        ->where('id', '!=', $student->parent_id )
        ->first();
    
        if ($existingEmail) {
            return response()->json(['success' => false, 'message' => 'The same email is already registered']);
        }
    
        $studentGuardian = [
            'first_name' => $request->parent_first_name,
            'last_name' => $request->parent_last_name,
            'middle_name' => $request->parent_middle_name,
            'suffix' => $request->parent_suffix,
            'sex' => $request->parent_sex,
            'email' => $request->email,
            'contact_no' => $request->parent_contact_no,
            'address' => $request->address,
        ];
    
        $guardian->update($studentGuardian);
    
        $current_school_year = SchoolYear::where('is_current', true)->first();
    
        if (!is_null($guardian)) {
            $studentArray = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'suffix' => $request->suffix,
                'sex' => $request->sex,
                'lrn' => $request->lrn,
                'dob' => $request->dob,
                'address' => $request->address,
                'grade_level' => $request->grade_level,
                'parent_id' => $guardian->id,
                'school_year_id' => $current_school_year->id
            ];
    
            $student->update($studentArray);
    
            if ($student->wasChanged()) {
                return response()->json(['success' => true, 'message' => 'Student information has been updated']);
            } else {
                return response()->json(['success' => false, 'message' => 'Nothing was changed']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful, please check the details of Guardian']);
        }
    }

    public function delete($id) {
        $student = Student::find($id);
        if ($student) {
            $student->is_archived = true;
            $student->save();
            return response()->json(['success' => true, 'message' => 'Student deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Section not found.']);
        }
    }
    

    public function import() {

    }
}
