<?php

namespace App\Http\Controllers;

use App\Models\Quarter;
use App\Models\Section;
use App\Models\Subjects;
use App\Models\SchoolYear;
use App\Models\ClassRecord;
use Illuminate\Http\Request;
use App\Models\SectionSubjects;
use App\Models\EvaluationCriteria;
use Illuminate\Support\Facades\DB;
use App\Models\ClassRecordEvaluationCriteria;

class SectionSubjectsController extends Controller
{
    public function store(Request $request, $id)
    {
        $current_school_year = SchoolYear::where('is_current', true)->first();
        $subject = Subjects::find($request->subjectId);
        $section = Section::find($id);

        $sectionSubjectExists = SectionSubjects::where('section_id', $id)
            ->where('subjects_id', $request->subjectId)
            ->where('school_year_id', $current_school_year->id)
            ->first();

        if ($sectionSubjectExists) {
            return response()->json(['success' => false, 'message' => 'Subject already exists!']);
        }

        $sectionSubject = [
            'name' => $section->name . " - " . $subject->name,
            'section_id' => $id,
            'subjects_id' => $request->subjectId,
            'faculty_id' => $request->facultyId,
            'school_year_id' => $current_school_year->id
        ];

        $savedSectionSubjects = SectionSubjects::create($sectionSubject);

        if ($savedSectionSubjects) {

            $quarters = Quarter::all();

            foreach ($quarters as $quarter) {
                $class_record = [
                    'name' => $section->name . " | " . $subject->name,
                    'section_subjects_id' => $savedSectionSubjects->id,
                    'faculty_id' => $savedSectionSubjects->faculty_id,
                    'school_year_id' => $current_school_year->id,
                    'quarter_id' => $quarter->id,
                ];

                $savedClassRecord = ClassRecord::create($class_record);

                if ($savedClassRecord) {

                    $evaluationCriterias = EvaluationCriteria::all();
                    foreach ($evaluationCriterias as $evaluationCriteria) {
                        $classRecordEvaluationCriteria = [
                            'name' => $evaluationCriteria->name,
                            'class_record_id' => $savedClassRecord->id,
                            'evaluation_criteria_id' => $evaluationCriteria->id,
                        ];

                        ClassRecordEvaluationCriteria::create($classRecordEvaluationCriteria);
                    }
                }
            }

            return response()->json(['success' => true, 'message' => 'The Subjects has been added!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Adding unsuccessful!']);
        }

    }

    public function getSubjects(Request $request)
    {
        $current_school_year = SchoolYear::where('is_current', true)->first();

        $section = Section::find($request->section_id);
        $sectionSubjects = $section->sectionSubjects->where('school_year_id', $current_school_year->id);

        $data = [];

        foreach ($sectionSubjects as $sectionSubject) {
            $data[] = [
                'id' => $sectionSubject->id,
                'name' => $sectionSubject->name,
                'faculty' => $sectionSubject->faculty->user->profile->firstName . " " . $sectionSubject->faculty->user->profile->middleName . " " . $sectionSubject->faculty->user->profile->lastName,
            ];
        }

        return response()->json($data);
    }

    public function remove(Request $request)
    {
        $sectionSubject = SectionSubjects::find($request->subject_id);

        if (!$sectionSubject) {
            return response()->json(['success' => false, 'message' => 'Subject not found.']);
        }

        $classRecords = $sectionSubject->classRecords;
        
        foreach ($classRecords as $classRecord ) {
            $classRecord->delete();
        }
        
        $sectionSubject->delete();

        return response()->json(['success' => true, 'message' => 'Subject has been removed.']);

    }

}