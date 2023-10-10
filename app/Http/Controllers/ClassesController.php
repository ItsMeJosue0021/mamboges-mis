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
        $faculty = Faculty::where('user_id',$user->id)->first();
        $current_school_year = SchoolYear::where('is_current', true)->first();
        $classes = $faculty->sectionSubjects->where('school_year_id', $current_school_year->id);

        return view('classes.index', [
            'classes' => $classes
        ]);
    }

    public function classRecord(SectionSubjects $class) {
        
        $current_school_year = SchoolYear::where('is_current', true)->first();

        $section = Section::find($class->section_id);

        $sectionStudents = $section->sectionStudents->where('school_year_id', $current_school_year->id);
    
        return view('classes.class-record', [
            'students' => $sectionStudents
        ]);
    } 
}
