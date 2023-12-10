<?php

namespace App\Http\Controllers\StudentAccess;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function portal() {

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $student = Student::where('lrn', Auth::user()->username)->first();

        $currentSection = $student->sectionStudents->where('school_year_id', $current_school_year->id)->first();

        $grades = Grade::where('student_id', $student->id)->get();

        return view('portal.index', [
            'student' => $student,
            'section' => $currentSection->section ?? null,
            'classes' => $student->sectionStudents,
            'grades' => $grades,
            'school_year' => $current_school_year,
        ]);
    }

    public function account(Request $request) {
        return view('profile.student-profile', [
            'user' => $request->user(),
        ]);
    }
}
