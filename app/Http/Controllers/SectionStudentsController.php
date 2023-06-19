<?php

namespace App\Http\Controllers;

use App\Helpers\Logs;
use App\Models\Section;
use App\Models\Student;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use Illuminate\Support\Facades\DB;

class SectionStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $current_school_year = SchoolYear::where('is_current', true)->first();

        $existingStudent = SectionStudents::where('student_id', $request->student_id)
                                            ->where('school_year_id', $current_school_year->id)
                                            ->first();

        $section = Section::where('id', $request->section_id)->first();

        $section_gradeLevel = '';
        if ($section->grade_level == 0) {
            $section_gradeLevel = 'kinder';
        } else {
            $section_gradeLevel = $section->grade_level;
        }

        $student = Student::find($request->student_id);

        // if ($student) {
        //     $student->section_id = $request->section_id;
        //     $student->grade_level = $section->grade_level;
        //     $student->save();
        // } else {
        //     return response()->json(['success' => false, 'message' => 'Student not found.']);
        // }

        if ($student->is_archived == true) {
            return response()->json(['success' => false, 'message' => 'Student has been archived already']);
        }

        $addStudent = [
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
            'school_year_id' => $current_school_year->id,
            'grade_level' => $section_gradeLevel
        ];

        if ($existingStudent) {
            return response()->json(['success' => false, 'message' => 'Student already added.']);
        } else {

            $addedStudent = SectionStudents::create($addStudent);

            if (!is_null($addedStudent)) {

                $student->section_id = $request->section_id;
                $student->grade_level = $section_gradeLevel;
                $student->save();

                Logs::addToLog('Student [' . $request->student_id . '] has been added to Section [' . $request->section_id . ']');
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public function getStudents(Request $request) {

        $current_school_year = SchoolYear::where('is_current', true)->first();

        if($request->ajax()) {

            $output = '';

            $students = DB::table('section_students')
                    ->orderBy('id', 'desc')
                    ->where('section_id', $request->section_id)
                    ->where('school_year_id', $current_school_year->id)
                    ->get();
                

            $total_students = $students->count();

            if($total_students > 0){
                foreach($students as $student)
                {
                    $stud = DB::table('students')
                    ->where('id', $student->student_id)
                    ->first();

                    if ($stud) {
                        $output .= '
                        <div class="flex justify-between space-x-6 px-2 py-2 border-b border-gray-300" >
                            <div class="flex space-x-2">
                                <p class="poppins text-base text-gray-700">'.$stud->first_name.'</p>
                                <p class="poppins text-base text-gray-700">'.$stud->last_name.'</p>
                                <p class="poppins text-base text-gray-700">'.$stud->middle_name.'</p>
                            </div>
                            <div id="button-container">
                                <button id="'.$stud->id.'" class="removestudentbtn poppins text-xs text-red-400 py-1 px-2 rounded border border-red-400 hover:border-red-500 hover:bg-red-500 hover:text-white">unenroll</button>
                            </div>
                        </div>
                        ';
                    }
                }
            } else {
                $output = '
                <div class="h-64 flex items-center justify-center">
                    <p class="poppins text-red-500 text-sm text-center">No Students Found</p>
                </div>
                ';
            }
            $students = array(
                'student_data'  => $output,
                'student_count' =>  $total_students
            );
            echo json_encode($students);       
        }
        
    }

    public function remove(Request $request) {
        
        $current_school_year = SchoolYear::where('is_current', true)->first();

        $sectionStudent = SectionStudents::where('student_id', $request->student_id)
                                            ->where('school_year_id', $current_school_year->id)
                                            ->first();

        if ($sectionStudent) {

            $student = Student::where('id', $request->student_id)->where('is_archived', false)->first();

            if ($student) {
                $student->section_id = null;
                $student->grade_level = "unenrolled";
                $student->save();
            }

            if ($sectionStudent->delete()) {
                Logs::addToLog('Student [' . $request->student_id . '] has been remove from Section [' . $sectionStudent->section_id . ']');
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Unable to delete student.']);
            }

        } else {
            return response()->json(['success' => false, 'message' => 'Student not found.']);
        }
        
    }

}
