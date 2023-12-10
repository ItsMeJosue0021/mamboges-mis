<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\ClassRecord;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function release(Request $request) {
        // dd($request->all());

        $gradesData = $request->input('grades', []);

        $gradesExist = Grade::where('class_record_id', $request->class_record)
        ->where('quarter_id', $request->quarter)
        ->where('section_id', $request->section)
        ->where('subjects_id', $request->subject)
        ->where('school_year_id', $request->school_year)
        ->exists();

        if ($gradesExist) {
            return back()->with('error', 'Grades already released.');
        }

        foreach ($gradesData as $studentId => $grade) {

            $remarks = '';
            if ($grade) {
                if ($grade >= 90 && $grade <= 100) {
                    $remarks = 'Outstanding';
                } elseif ($grade >= 85 && $grade <= 89) {
                    $remarks = 'Strongly Satisfactory';
                } elseif ($grade >= 80 && $grade <= 84) {
                    $remarks = 'Satisfactory';
                } elseif ($grade >= 75 && $grade <= 79) {
                    $remarks = 'Fairly Satisfactory';
                } elseif ($grade < 75) {
                    $remarks = 'Did Not Meet Expectations';
                } else {
                    $remarks = 'Did Not Meet Expectations';
                }
            }

            $gradeSaved = Grade::create([
                'class_record_id' => $request->class_record,
                'student_id' => $studentId,
                'quarter_id' => $request->quarter,
                'section_id' => $request->section,
                'subjects_id' => $request->subject,
                'school_year_id' => $request->school_year,
                'remarks' => $remarks,
                'grade' => $grade,
            ]);
        }

        if (!$gradeSaved) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }

        $class_record = ClassRecord::where('id', $request->class_record)->first();
        $class_record->is_released = true;
        $class_record->save();

        return back()->with('success', 'Grades has been released.');
    }

    public function unrelease(Request $request) {
        $grades = Grade::where('class_record_id', $request->class_record)
                ->where('quarter_id', $request->quarter)
                ->where('section_id', $request->section)
                ->where('subjects_id', $request->subject)
                ->where('school_year_id', $request->school_year)->get();
        if ($grades) {
            foreach ($grades as $grade) {
                $grade->delete();
            }

            $class_record = ClassRecord::where('id', $request->class_record)->first();
            $class_record->is_released = false;
            $class_record->save();
        }

        return back()->with('success', 'Grade has been unrelease.');
    }
}
