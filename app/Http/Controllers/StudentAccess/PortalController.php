<?php

namespace App\Http\Controllers\StudentAccess;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function portal() {

        $student = Student::where('lrn', Auth::user()->username)->first();

        $studentSection = SectionStudents::where('student_id', $student->id)->where('school_year_id', $current_school_year->id)->first();

        $section = Section::where('id', $studentSection->section_id)->where('is_archived', false)->first();



        return view('student.portal', [
            'student' => $student,
            'section' => $section,
            'parent' => $parent,
            'student_section' => $studentSection
        ]);
    }

    public function account(Request $request) {
        return view('profile.student-profile', [
            'user' => $request->user(),
        ]);
    }
}
