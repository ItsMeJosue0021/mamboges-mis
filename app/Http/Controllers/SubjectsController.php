<?php

namespace App\Http\Controllers;

use App\Helpers\Logs;
use App\Models\Subjects;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subjects::all();

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
            'name' => $request->subject_name,
        ];

        if (Subjects::create($subject)) {
            Logs::addToLog('New subject has been added | SUBJECT [' . $request->subject_name . ']');
            return response()->json(['success' => true, 'message' => 'New subject has been added!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful!']);
        }
    }


    public function update(Request $request, $id)
    {
        $subject = Subjects::find($id);
        $subjectName = $subject->name;

        $editSubject = [
            'name' => $request->edit_subject_name
        ];

        $subject->update($editSubject);

        if ($subject->wasChanged()) {
            Logs::addToLog('A subject has been updated from [' . $subjectName . '] to [' . $request->subject_name . ']');
            return response()->json(['success' => true, 'message' => 'Subject has been updated!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Nothing was changed!']);
        }
    }

    public function delete($id)
    {
        $subject = Subjects::find($id);
        if ($subject->delete()) {
            Logs::addToLog('A subject has been deleted | SUBJECT [' . $subject->name . ']');
            return response()->json(['success' => true, 'message' => 'Subject deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Subject not found.']);
        }
    }
}
