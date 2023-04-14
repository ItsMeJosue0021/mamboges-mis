<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionSubjects;

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
