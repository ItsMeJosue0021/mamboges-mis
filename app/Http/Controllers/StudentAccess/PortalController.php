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

        $studentSection = SectionStudents::where('student_id', $student->id)
                                        ->where('school_year_id', $current_school_year->id)->first();

        // $sectionId = $studentSection->section_id;
        $section = '';
        if ($studentSection) {
            $section = Section::where('id', $studentSection->section_id)->where('is_archived', false)->first();
        }

        return view('student.portal', [
            'student' => $student,
            'section' => $section,
            'student_section' => $studentSection
        ]);
    }

    public function account(Request $request) {
        return view('profile.student-profile', [
            'user' => $request->user(),
        ]);
    }
}
