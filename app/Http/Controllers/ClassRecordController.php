<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolYear;
use App\Models\ClassRecord;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Models\SectionSubjects;
use App\Models\EvaluationCriteria;

class ClassRecordController extends Controller
{
    public function index(SectionSubjects $class) {

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $class_record = ClassRecord::where('section_subject_id', $class->id)->first();

        $class_record_evaluation_criterias = $class_record->evaluationCriterias;


        $wr_activities = $class_record_evaluation_criterias->where('name', 'Written Works')->first()->activities;
        // $wr_activities = $activities->activities;


        $section_students = SectionStudents::where('section_id', $class->section_id)
        ->where('school_year_id',  $current_school_year->id)
        ->get();
    
        $students = [];
        foreach ($section_students as $student) {
            $student_record = Student::where('id', $student->student_id)->first();
            if ($student_record) {
                $students[] = $student_record;
            }
        }
    
        return view('classes.class-record', [
            'students' => $students,
            'evaluations' => $class_record_evaluation_criterias,
            'class_record' => $class_record,
            'wr_activities' => $wr_activities
        ]);
    }
}
