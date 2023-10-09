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

    public function store(Request $request)
    {
        $current_school_year = SchoolYear::where('is_current', true)->first();

        $existingStudent = SectionStudents::where('student_id', $request->student_id)
            ->where('school_year_id', $current_school_year->id)
            ->first();

        if ($existingStudent) {
            return response()->json([
                'success' => false,
                'message' => 'Student already enrolled in this section.'
            ]);
        } else {

            $studentAdded = SectionStudents::create([
                'section_id' => $request->section_id,
                'student_id' => $request->student_id,
                'school_year_id' => $current_school_year->id
            ]);

            if ($studentAdded) {
                $student = Student::find($request->student_id);
                $student->isEnrolled = true;
                $student->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Student added to section.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to add student'
                ]);
            }
        }
    }

    // public function getStudents(Request $request)
    // {

    //     $current_school_year = SchoolYear::where('is_current', true)->first();

    //     $section = Section::find($request->section_id);
    //     $scetionStudents = $section->sectionStudents->where('school_year_id', $current_school_year->id);

    //     $data = [];
        
    //     foreach ($scetionStudents as $scetionStudent) {
    //         $data[] = [
    //             'id' => $scetionStudent->id,
    //             'lrn' => $scetionStudent->student->lrn,
    //             'firstName' => $scetionStudent->student->user->profile->firstName,
    //             'middleName' => $scetionStudent->student->user->profile->middleName,
    //             'lastName' => $scetionStudent->student->user->profile->lastName,
    //         ];
    //     }

    //     return response()->json($data);

    // }

    public function getStudents(Request $request)
    {
        $current_school_year = SchoolYear::where('is_current', true)->first();

        $section = Section::find($request->section_id);
        $sectionStudents = $section->sectionStudents->where('school_year_id', $current_school_year->id);

        $data = [];
        
        // Initialize the student count
        $studentCount = 0;

        foreach ($sectionStudents as $sectionStudent) {
            $data[] = [
                'id' => $sectionStudent->id,
                'lrn' => $sectionStudent->student->lrn,
                'firstName' => $sectionStudent->student->user->profile->firstName,
                'middleName' => $sectionStudent->student->user->profile->middleName,
                'lastName' => $sectionStudent->student->user->profile->lastName,
            ];
            
            // Increment the student count
            $studentCount++;
        }

        // Add the student count to the response
        $response = [
            'studentCount' => $studentCount,
            'students' => $data,
        ];

        return response()->json($response);
    }


    public function remove(Request $request)
    {
        $studentSection = SectionStudents::find($request->sectionStudentId);
        $student = $studentSection->student;

        if (!$studentSection) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
            ]);
        } else {
            $studentSection->delete();

            $student->isEnrolled = false;
            $student->save();

            return response()->json([
                'success' => true,
                'message' => 'Student removed from section.'
            ]);
        }
    }

}