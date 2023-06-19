<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Section;
use App\Models\Student;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Models\SectionSubjects;

class ClassesController extends Controller
{
    public function index() {
        
        $user = auth()->user();

        $faculty = Faculty::where('email', $user->username)->first();

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $classes = SectionSubjects::where('faculty_id', $faculty->id)->where('school_year_id',  $current_school_year->id)->get();

        return view('classes.index', [
            'classes' => $classes
        ]);
    }

    public function classRecord(SectionSubjects $class) {
        
        $current_school_year = SchoolYear::where('is_current', true)->first();

        $section_students = SectionStudents::where('section_id', $class->section_id)
        ->where('school_year_id',  $current_school_year->id)
        ->get();
    
        $students = [];
    
        foreach ($section_students as $student) {
            $student_record = Student::where('id', $student->student_id)->first();
            if ($student_record) {
                $students[] = $student_record;
            }
        }
    
        return view('classes.class-record', [
            'students' => $students
        ]);
    } 
}
