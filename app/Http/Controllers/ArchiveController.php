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

    public function showArchivedStudent($id) {

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $archivedStudent = ArchivedStudents::where('student_id', $id)->first();

        $section = Section::where('id', $archivedStudent->section_id)->where('is_archived', false)->first();

        $gradeLevel = $archivedStudent->grade_level;

        $parent = Guardian::where('id', $archivedStudent->parent_id)->first();
        
        return view('archive.show', [
            'student' => $archivedStudent,
            'section' => $section,
            'parent' => $parent,
            'grade_level' => $gradeLevel
        ]);

    }

    public function showArchivedFaculty($id) {

    }
    
}
