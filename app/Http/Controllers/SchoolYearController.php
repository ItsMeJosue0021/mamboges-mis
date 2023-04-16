<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Http\Controllers\SchoolYearController;

class SchoolYearController extends Controller
{

    public function getSchoolYears(Request $request)
    {
        if($request->ajax()) {

            $output = '';

            $schoolYears = SchoolYear::orderBy('name', 'desc')->get();

            $total_schoolYears = $schoolYears->count();

            $currentSchoolYear = SchoolYear::where('is_current', true)->first();

            if($total_schoolYears > 0){
                foreach ($schoolYears as $schoolYear) {
                    $selected = '';
                    if ($schoolYear->id == $currentSchoolYear->id) {
                        $selected = 'selected';
                    }
                
                    $output .= 
                    '<option value="' . $schoolYear->id . '" ' . $selected . '>' . $schoolYear->name . '</option>
                    ';
                }
            } else {
                $output = '
                <option disabled value="">No Data Avilable</option>
                ';
            }
            $schoolYears = array(
                'school_years'  => $output,
            );
            echo json_encode($schoolYears);       
        }
    }

    public function changeSchoolYear(Request $request)
    {
        $currentSchoolYear = SchoolYear::where('is_current', true)->first();

        $newSchoolYear = SchoolYear::where('id', $request->new_school_year)->first();

        if ($currentSchoolYear) {

            $currentSchoolYear->is_current = false;
            $currentSchoolYear->save();

            $newSchoolYear->is_current = true;
            $newSchoolYear->save();

            if ($currentSchoolYear && $newSchoolYear) {
                return response()->json(['success' => true, 'message' => 'School year has been changed']);
            } else {
                return response()->json(['success' => true, 'message' => 'Please try again']);
            }

        } else {
            return response()->json(['success' => true, 'message' => 'Cannot find school year']);
        }

    }


    public function store(Request $request)
    {
        $schoolYear = [
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];

        $saveSchoolYear = SchoolYear::create($schoolYear);

        if ($saveSchoolYear) {
            return response()->json(['success' => true, 'message' => 'New school year has been added.']);
        } else {
            return response()->json(['success' => true, 'message' => 'Please try again']);
        }

    }

    public function show(SchoolYear $schoolYear) 
    {
        //
    }


    public function edit(SchoolYear $schoolYear)
    {
        //
    }


    public function update(Request $request, SchoolYear $schoolYear)
    {
        //
    }


    public function destroy(SchoolYear $schoolYear)
    {
        //
    }
}
