<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subjects::where('is_archived', false)->get();

        return view('subjects.index', [
            'subjects' => $subjects
        ]);

    }


    public function getSubject($id) {
        $subject = Subjects::findOrFail($id);
        return response()->json($subject);
    }


    public function store(Request $request)
    {
        $subject = [
            'subject_name' => $request->subject_name,
            'grade_level' => $request->grade_level,
        ];

        $savedSubject = Subjects::create($subject);

        if (!is_null($savedSubject)) {
            return response()->json(['success' => true, 'message' => 'New subject has been added!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful!']);
        }
    }


    public function update(Request $request, $id)
    {
        $subject = Subjects::find($id);

        $editSubject = [
            'subject_name' => $request->edit_subject_name,
            'grade_level' => $request->edit_grade_level,
        ];

        $subject->update($editSubject);

        if ($subject->wasChanged()) {
            return response()->json(['success' => true, 'message' => 'Subject has been updated!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Nothing was changed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $subject = Subjects::find($id);
        if ($subject) {
            $subject->is_archived = true;
            $subject->save();
            return response()->json(['success' => true, 'message' => 'Subject deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Subject not found.']);
        }
    }
}
