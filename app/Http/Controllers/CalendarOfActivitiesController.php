<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarOfActivities;
use Illuminate\Support\Facades\Response;

class CalendarOfActivitiesController extends Controller
{
    public function index()
    {
        return view('calendar.index', [
            'calendars' => CalendarOfActivities::all()
        ]);
    }

    public function show() {
        return view('calendar.show', [
            'calendars' => CalendarOfActivities::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fileName' => 'required|mimes:pdf'
        ]);

        if ($request->hasFile('fileName')) {
            $file = $request->file('fileName');
            $filePath = $file->store('calendar', 'public');

            $currentYear = date('Y');
            $nextYear = $currentYear + 1;

            $calendarOfActivities = CalendarOfActivities::create([
                'name' => 'Calendar of Activities ' . $currentYear . '-' . $nextYear,
                'fileName' => $filePath,
            ]);

            if (!$calendarOfActivities) {
                return redirect()->back()->with('error', 'Failed to upload the file. Please try again.');
            }

            return redirect()->back()->with('success', 'File has been uploaded.');
        }

        return redirect()->back()->with('message', 'No files were uploaded.');

    }

    public function edit($id)
    {
        $calendar = CalendarOfActivities::find($id);

        if (!$calendar) {
            return redirect()->back()->with('error', 'File not found.');
        }
        return view('calendar.edit', [
            'calendar' => $calendar
        ]);
    }

    public function update(Request $request, $id)
    {

        $calendarOfActivities = CalendarOfActivities::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        $calendarOfActivities->name = $request->name;

        if ($request->hasFile('fileName')) {
            $file = $request->file('fileName');
            $filePath = $file->store('calendar', 'public');

            $calendarOfActivities->fileName = $filePath;
        }

        $calendarOfActivities->save();

        if (!$calendarOfActivities) {
            return redirect()->back()->with('error', 'Failed to upload the file. Please try again.');
        }

        return redirect()->back()->with('success', 'File has been uploaded.');

    }

    public function destroy($id)
    {
        $calendarOfActivities = CalendarOfActivities::find($id);

        if (!$calendarOfActivities) {
            return redirect()->back()->with('error', 'Failed to delete the file. Please try again.');
        }
        $calendarOfActivities->delete();

        return redirect()->back()->with('success', 'File has been deleted.');
    }

    public function view($id)
    {
        $file = CalendarOfActivities::find($id);
        $fileName = $file->fileName;

        $filePath = public_path('storage/' . $fileName);

        if (file_exists($filePath)) {
            return Response::stream(function () use ($filePath) {
                readfile($filePath);
            }, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            ]);
        } else {
            return back()->with('error', 'PDF file not found');
        }
    }
}
