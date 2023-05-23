<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Guardian;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Models\ArchivedStudents;
use App\Models\ArchivedFaculties;

class ArchiveController extends Controller
{
    public function index()
    {
        $archivedStudents = ArchivedStudents::all();
    
        $sectionIds = $archivedStudents->pluck('section_id')->unique();
    
        $sections = Section::whereIn('id', $sectionIds)->get();
    
        $sectionNames = $sections->pluck('name', 'id');
    
        $archivedFaculties = ArchivedFaculties::all();
    
        return view('archive.index', [
            'students' => $archivedStudents,
            'sectionNames' => $sectionNames,
            'faculties' => $archivedFaculties
        ]);
    }

    public function show($id) {

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $archivedStudent = ArchivedStudents::where('id', $id)->first();

        // return view('archive.show', [
        //     'student' => $archivedStudent
        // ]);


        $studentSection = SectionStudents::where('student_id', $archivedStudent->student_id)
                                          ->where('school_year_id', $current_school_year->id)->first();

        if (!is_null($studentSection)) {
            $section = Section::where('id', $studentSection->section_id)->where('is_archived', false)->first();
        } else {
            $section = Section::where('id', $archivedStudent->section_id)->where('is_archived', false)->first();
        }

        $parent = Guardian::where('id', $archivedStudent->parent_id)->first();
        
        return view('student.show', [
            'student' => $archivedStudent,
            'section' => $section,
            'parent' => $parent,
            'student_section' => $studentSection
        ]);

    }
    
}
