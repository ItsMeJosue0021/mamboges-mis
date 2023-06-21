<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Department;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Models\SectionSubjects;
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

        $departments = Department::all();
    
        return view('archive.index', [
            'students' => $archivedStudents,
            'sectionNames' => $sectionNames,
            'faculties' => $archivedFaculties,
            'departments'=> $departments
        ]);
    }

    public function showArchivedStudent($id) {

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $archivedStudent = ArchivedStudents::where('student_id', $id)->first();

        $section = Section::where('id', $archivedStudent->section_id)->where('is_archived', false)->first();

        $gradeLevel = $archivedStudent->grade_level;

        $parent = Guardian::where('id', $archivedStudent->parent_id)->first();
        
        return view('archive.archived-student', [
            'student' => $archivedStudent,
            'section' => $section,
            'parent' => $parent,
            'grade_level' => $gradeLevel
        ]);

    }

    public function showArchivedFaculty($id) {

        $departments = Department::all();

        $faculty = ArchivedFaculties::where('faculty_id', $id)->first();

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $classes = SectionSubjects::where('faculty_id', $faculty->faculty_id)->get();

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

        return view('archive.archived-faculty', [
            'faculty' => $faculty,
            'departments' => $departments,
            'students' => $students,
            'classes' => $classes
        ]);
    }
    
}
