<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
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

    public function students() {
        $students = Student::onlyTrashed()->get();
        return view('archive.students', [
            'students' => $students,
        ]);
    }

    public function faculties() {
        $faculty = Faculty::onlyTrashed()->get();
        return view('archive.faculty', [
            'faculties' => $faculty,
        ]);
    }

    public function restoreStudent($studentId) {
        $student = Student::onlyTrashed()->find($studentId);
        if (!$student) {
            return redirect()->back()->with('error','No record found.');
        }
        if ($student->restore()) {
            // $student = Student::find($studentId);
            foreach($student->sectionStudents()->onlyTrashed()->get() as $sectionStudent) {
                $sectionStudent->restore();
            }
            return redirect()->back()->with('success','Student has been restored.');
        }
    }

    public function restoreFaculty($facultyId) {
        $faculty = Faculty::onlyTrashed()->find($facultyId);
        if (!$faculty) {
            return redirect()->back()->with('error','No record found.');
        }
        if ($faculty->restore()) {
            return redirect()->back()->with('success','Faculty has been restored.');
        }
    }




}
