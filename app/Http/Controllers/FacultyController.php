<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Logs;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Department;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Models\SectionSubjects;
use App\Models\ArchivedFaculties;
use Illuminate\Support\Facades\Hash;

class FacultyController extends Controller
{
    public function index() {

        $faculties = Faculty::where('is_archived', false)->filter(Request(['search']))->latest()->get();

        $departments = Department::all();


        return view('faculty.index', [
            'faculties' => $faculties,
            'departments' => $departments,
        ]);
    }

    // public function show(Faculty $faculty) {

    //     $departments = Department::all();

    //     $current_school_year = SchoolYear::where('is_current', true)->first();
        
    //     $classes = SectionSubjects::where('faculty_id', $faculty->id)->where('school_year_id',  $current_school_year->id)->get();

    //     foreach($classes as $class) {
    //         $section_students = SectionStudents::where('section_id', $class->section_id)->get();
    
    //         $students = [];
        
    //         foreach ($section_students as $student) {
    //             $student_record = Student::where('id', $student->student_id)->first();
    //             if ($student_record) {
    //                 $students[] = $student_record;
    //             }
    //         }
    //     }
    
    //     return view('faculty.show', [
    //         'faculty' => $faculty,
    //         'departments' => $departments,
    //         'classes' => $classes,
    //         'students' => $students
    //     ]);
    // }

    public function show(Faculty $faculty)
    {
        $departments = Department::all();
        $current_school_year = SchoolYear::where('is_current', true)->first();
        $classes = SectionSubjects::where('faculty_id', $faculty->id)
            ->where('school_year_id',  $current_school_year->id)
            ->get();

        $students = [];

        foreach ($classes as $class) {
            $section_students = SectionStudents::where('section_id', $class->section_id)
            ->where('school_year_id',  $current_school_year->id)
            ->get();

            $class_students = [];

            foreach ($section_students as $student) {
                $student_record = Student::where('id', $student->student_id)->first();
                if ($student_record) {
                    $class_students[] = $student_record;
                }
            }

            $students[$class->section_id] = $class_students;
        }

        return view('faculty.show', [
            'faculty' => $faculty,
            'departments' => $departments,
            'classes' => $classes,
            'students' => $students
        ]);
    }



    public function store(Request $request) {

        $existingEmail = Faculty::where('email', $request->email)->where('is_archived', false)->first();

        $existingUserEmail = User::where('email', $request->email)->first();

        if ($existingEmail ||  $existingUserEmail) {
            return response()->json(['success' => false, 'message' => 'The email already exist.']);
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

        $faculty = Faculty::where('id', $id)->first();

        if ($faculty) {

            $toBeArchived = [
                'faculty_id' => $faculty->id,
                'first_name' => $faculty->first_name,
                'last_name' => $faculty->last_name,
                'middle_name' => $faculty->middle_name,
                'suffix' => $faculty->suffix,
                'sex' => $faculty->sex,
                'email' => $faculty->email,
                'contact_no' => $faculty->contact_no,
                'image' => $faculty->image,
                'department_id' => $faculty->department_id,
            ];

            $archivedFaculty = ArchivedFaculties::create($toBeArchived);

            if (!is_null($archivedFaculty)) {

                if ($faculty->delete()) {

                    Logs::addToLog('A faculty member has been moved to archive | EMAIL [' . $faculty->email . ']');

                    return response()->json(['success' => true, 'message' => 'Faculty deleted successfully']);
                    
                } else {
                    return response()->json(['success' => false, 'message' => 'Unable to delete faculty']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Something went wrong']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Faculty not found.']);
        }
        
    }


    public function dashboard() {
        return view('faculty.dashboard');
    }
}
