<?php

namespace App\Http\Controllers;

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

        $student = Student::find($request->student_id);
        if ($student) {
            $student->section_id = $request->section_id;
            $student->save();
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found.']);
        }

        $addStudent = [
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
            'school_year_id' => $current_school_year->id
        ];

        $addedStudent = SectionStudents::create($addStudent);

        if (!is_null($addedStudent)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }

    }

    public function getStudents(Request $request) {

        if($request->ajax()) {

            $output = '';

            $students = DB::table('section_students')
                    ->orderBy('id', 'desc')
                    ->where('section_id', $request->section_id)
                    ->where('is_archived', false)
                    ->get();
                

            $total_students = $students->count();

            if($total_students > 0){
                foreach($students as $student)
                {
                    $stud = DB::table('students')
                    ->where('id', $student->student_id)
                    ->where('is_archived', false)
                    ->first();

                    $output .= '
                    <div class="flex justify-between space-x-6 px-2 py-2 border-t border-gray-300" >
                        <div class="flex space-x-2">
                            <p class="poppins text-base text-gray-700">'.$stud->first_name.'</p>
                            <p class="poppins text-base text-gray-700">'.$stud->last_name.'</p>
                            <p class="poppins text-base text-gray-700">'.$stud->middle_name.'</p>
                        </div>
                        <div id="button-container">
                            <button id="'.$stud->id.'" class="removestudentbtn poppins text-xs text-red-500 py-1 px-2 rounded border border-red-500 hover:bg-red-500 hover:text-white">remove</button>
                        </div>
                    </div>
                    ';
                }
            } else {
                $output = '
                <div>
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

        $sectionStudent = SectionStudents::where('student_id', $request->student_id)->first();

        if ($sectionStudent) {

            $student = Student::where('id', $request->student_id)->where('is_archived', false)->first();

            if ($student) {
                $student->section_id = null;
                $student->save();
            }

            $sectionStudent->is_archived = true;
            $sectionStudent->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found.']);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(SectionStudents $sectionStudents)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SectionStudents $sectionStudents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SectionStudents $sectionStudents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SectionStudents $sectionStudents)
    {
        //
    }
}
