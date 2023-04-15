<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionSubjects;
use Illuminate\Support\Facades\DB;

class SectionSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $current_school_year = SchoolYear::where('is_current', true)->first();

        $sectionSubject = [
            'section_id' => $id,
            'subject_id' => $request->subject,
            'faculty_id' => $request->teacher,
            'school_year_id' => $current_school_year->id
        ];

        $savedSectionSubjects = SectionSubjects::create($sectionSubject);

        if (!is_null($savedSectionSubjects)) {
            return response()->json(['success' => true, 'message' => 'The Subjects has been added!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Adding unsuccessful!']);
        }
        
    }

    public function getSubjects(Request $request) {

        if($request->ajax()) {

            $output = '';

            $subjects = DB::table('section_subjects')
                    ->orderBy('id', 'desc')
                    ->where('section_id', $request->section_id)
                    ->get();
                

            $total_subjects = $subjects->count();

            if($total_subjects > 0){
                foreach($subjects as $subject)
                {
                    $subj = DB::table('subjects')
                    ->where('id', $subject->subject_id)
                    ->first();

                    $output .= '
                    <div class="flex justify-between space-x-6 px-2 py-2 border-t border-gray-300" >
                        <div class="flex space-x-2">
                            <p class="poppins text-base text-gray-700">'.$subj->subject_name.'</p>
                        </div>
                        <div id="button-container">
                            <button id="'.$subj->id.'" class="removesubjectbtn poppins text-xs text-red-400 py-1 px-2 rounded border border-red-400 hover:border-red-500 hover:bg-red-500 hover:text-white">remove</button>
                        </div>
                    </div>
                    ';
                }
            } else {
                $output = '
                <div>
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

    /**
     * Display the specified resource.
     */
    public function show(SectionSubjects $sectionSubjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SectionSubjects $sectionSubjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SectionSubjects $sectionSubjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SectionSubjects $sectionSubjects)
    {
        //
    }
}
