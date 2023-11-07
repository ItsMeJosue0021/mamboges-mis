<?php

namespace App\Http\Controllers\StudentAccess;

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

        return view('student.portal', [
            'student' => $student,
            'section' => $currentSection->section,
        ]);
    }

    public function account(Request $request) {
        return view('profile.student-profile', [
            'user' => $request->user(),
        ]);
    }
}
