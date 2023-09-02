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

        $subject = Subjects::where('id', $request->subject)->first();

        $section = Section::where('id', $id)->first();

        $sectionSubject = [
            'name' => $section->name . " | " . $subject->subject_name,
            'section_id' => $id,
            'subject_id' => $request->subject,
            'faculty_id' => $request->teacher,
            'school_year_id' => $current_school_year->id
        ]; 

        $savedSectionSubjects = SectionSubjects::create($sectionSubject);

        if ($savedSectionSubjects) {

            $quarters = Quarter::all();
            foreach($quarters as $quarter) {

                $class_record = [
                    'name' => $section->name . " | " . $subject->subject_name,
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

    public function getSubjects(Request $request) {

        $current_school_year = SchoolYear::where('is_current', true)->first();

        if($request->ajax()) {

            $output = '';

            $subjects = DB::table('section_subjects')
                    ->orderBy('id', 'desc')
                    ->where('section_id', $request->section_id)
                    ->where('school_year_id', $current_school_year->id)
                    ->get();
                

            $total_subjects = $subjects->count();

            if($total_subjects > 0){
                foreach($subjects as $subject)
                {
                    $subj = DB::table('subjects')
                    ->where('id', $subject->subject_id)
                    ->first();

                    if ($subj) {

                        $faculty = DB::table('faculties')
                        ->where('id', $subject->faculty_id)
                        ->first();

                        $output .= '
                            <div class="flex justify-between space-x-6 px-2 py-2 border-b border-gray-300" >
                                <div class="flex space-x-2">
                                    <p class="poppins text-base text-blue-500 ">'.$subj->subject_name.' <span class="poppins text-base text-gray-700">|</span> </p>
                                    <div class="flex space-x-2">';
                                if ($faculty) {
                                    $output .= '
                                            <p class="poppins text-base text-gray-700">' . $faculty->first_name . '</p>
                                            <p class="poppins text-base text-gray-700">' . $faculty->middle_name . '</p>
                                            <p class="poppins text-base text-gray-700">' . $faculty->last_name . '</p>
                                        ';
                                }
                                $output .='</div>
                                </div>
                                <div id="button-container">
                                    <button id="'.$subj->id.'" class="removesubjectbtn poppins text-xs text-red-400 py-1 px-2 rounded border border-red-400 hover:border-red-500 hover:bg-red-500 hover:text-white">remove</button>
                                </div>
                            </div>
                        ';
                    }

                }

            } else {
                $output = '
                <div class="h-64 flex items-center justify-center">
                    <p class="poppins text-red-500 text-sm text-center">No Subjects Found</p>
                </div>
                ';
            }
            $subjects = array(
                'subject_data'  => $output,
            );
            echo json_encode($subjects);       
        }
    }   

    public function remove(Request $request) {

        $sectionSubject = SectionSubjects::where('subject_id', $request->subject_id)
                        ->where('section_id', $request->section_id)->first();

        if ($sectionSubject) {
            if ($sectionSubject->delete()) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Unable to delete student.']);
            }

        } else {
            return response()->json(['success' => false, 'message' => 'Subject not found.']);
        }
        
    }

}
