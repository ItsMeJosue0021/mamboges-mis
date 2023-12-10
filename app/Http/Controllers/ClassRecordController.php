<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subjects;
use App\Models\SchoolYear;
use App\Models\ClassRecord;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Models\SectionSubjects;
use App\Models\EvaluationCriteria;

class ClassRecordController extends Controller
{
    public function index($id) {

        $class = SectionSubjects::where('id', $id)->first();

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $class_record = ClassRecord::where('section_subjects_id', $class->id)->filter(Request(['quarter']))->first();

        $class_record_evaluation_criterias = $class_record->classRecordEvaluationCriterias;

        $wr_activities = $class_record_evaluation_criterias->where('name', 'Written Works')->first()->activities;
        $pt_activities = $class_record_evaluation_criterias->where('name', 'Performance Tasks')->first()->activities;
        $qa_activities = $class_record_evaluation_criterias->where('name', 'Quarterly Assessments')->first()->activities;

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
            'wr_activities' => $wr_activities,
            'pt_activities' => $pt_activities,
            'qa_activities' => $qa_activities,
            'class' => $class,
            'current_school_year' => $current_school_year,
            'subjects' => Subjects::all(),
        ]);
    }

    public function printableClassRecord($id) {
        $class = SectionSubjects::where('id', $id)->first();

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $class_record = ClassRecord::where('section_subjects_id', $class->id)->filter(Request(['quarter']))->first();

        $class_record_evaluation_criterias = $class_record->classRecordEvaluationCriterias;

        $wr_activities = $class_record_evaluation_criterias->where('name', 'Written Works')->first()->activities;
        $pt_activities = $class_record_evaluation_criterias->where('name', 'Performance Tasks')->first()->activities;
        $qa_activities = $class_record_evaluation_criterias->where('name', 'Quarterly Assessments')->first()->activities;

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

        return view('classes.printable', [
            'students' => $students,
            'evaluations' => $class_record_evaluation_criterias,
            'class_record' => $class_record,
            'wr_activities' => $wr_activities,
            'pt_activities' => $pt_activities,
            'qa_activities' => $qa_activities,
            'class' => $class,
            'schoolYear' => $current_school_year,
            'subjects' => Subjects::all(),
        ]);
    }
}
