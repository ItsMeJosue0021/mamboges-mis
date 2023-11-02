<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Logs;
use App\Models\Faculty;
use App\Models\Profile;
use App\Models\Student;
use App\Models\Department;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Models\SectionSubjects;
use App\Models\ArchivedFaculties;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class FacultyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {

            $collection = collect([]);

            foreach (Faculty::all() as $faculty) {
                if (
                    strcasecmp($faculty->user->profile->lastName, $request->search) == 0 ||
                    strcasecmp($faculty->user->profile->firstName, $request->search) == 0 ||
                    strcasecmp($faculty->user->profile->middleName, $request->search) == 0
                ) {
                    $collection->push($faculty);
                }
            }

            $faculties = $this->paginator($collection, $request);
        } else {
            $faculties = Faculty::latest()->paginate(10);
        }

        return view('faculty.index', [
            'faculties' => $faculties,
            'departments' => Department::all(),
        ]);
    }

    public function paginator($collection, $request)
    {
        $perPage = 10;
        $page = request('page', 1);
        $faculties = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => route('faculties.index'), 'query' => $request->query()]
        );

        return $faculties;
    }

    public function show(Faculty $faculty)
    {
        $departments = Department::all();
        $current_school_year = SchoolYear::where('is_current', true)->first();
        $classes = SectionSubjects::where('faculty_id', $faculty->id)
            ->where('school_year_id', $current_school_year->id)
            ->get();

        $students = [];

        foreach ($classes as $class) {
            $section_students = SectionStudents::where('section_id', $class->section_id)
                ->where('school_year_id', $current_school_year->id)
                ->get();

            $class_students = [];

            foreach ($section_students as $student) {
                $student_record = Student::where('id', $student->student_id)->first();
                if ($student_record) {
                    $class_students[] = $student_record;
                }
            }

            $students[$class->section_id] = $class_students;
        }

        return view('faculty.show', [
            'faculty' => $faculty,
            'departments' => $departments,
            'classes' => $classes,
            'students' => $students
        ]);
    }



    public function store(Request $request)
    {

        $existingUserEmail = User::where('email', $request->email)->first();

        if ($existingUserEmail) {
            return response()->json(['success' => false, 'message' => 'The email already exist.']);
        }

        $facultyAccountData = [
            'email' => $request->email,
            'username' => $request->email,
            'password' => Hash::make($request->last_name),
            'type' => 'faculty',
        ];

        $facultyAccountSaved = User::create($facultyAccountData);

        if ($facultyAccountSaved) {

            $faculty = Faculty::create([
                'user_id' => $facultyAccountSaved->id,
                'department_id' => $request->department
            ]);

            if ($faculty) {

                $facultyProfileData = [
                    'firstName' => $request->first_name,
                    'lastName' => $request->last_name,
                    'middleName' => $request->middle_name,
                    'suffix' => $request->suffix,
                    'sex' => $request->sex,
                    'dob' => $request->dob,
                    'contactNumber' => $request->contact_no,
                    'image' => $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : null,
                    'user_id' => $facultyAccountSaved->id,
                ];

                Profile::create($facultyProfileData);

                return response()->json(['success' => true, 'message' => 'Faculty has been saved!']);
            }

        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }

        Logs::addToLog('New faculty has been added to the list | EMAIL [' . $facultyAccountSaved->email . ']');

    }

    public function update(Request $request, $facultyId)
    {
        $faculty = Faculty::find($facultyId);

        $profileUpdated = $faculty->user->profile->update([
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'middleName' => $request->middle_name,
            'suffix' => $request->suffix,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'contactNumber' => $request->contact_no,
            'image' => $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : $faculty->user->profile->image,
        ]);

        if (!$profileUpdated) {
            return response()->json(['success' => false, 'message' => 'There was a problem upadting the profile']);
        }

        $faulctyUpdated = $faculty->update([
            'department_id' => $request->department
        ]);

        if (!$faulctyUpdated) {
            return response()->json(['success' => false, 'message' => 'There was a problem upadting the department']);
        }

        Logs::addToLog('A faculty member information has been updated | EMAIL [' . $faculty->user->email . ']');
        return response()->json(['success' => true, 'message' => 'Faculty has been updated']);

    }

    public function archivingInfo(Faculty $faculty)
    {
        return view('faculty.delete', [
            'faculty' => $faculty,
        ]);
    }

    public function delete(Request $request, $facultyId)
    {

        $faculty = Faculty::where('id', $facultyId)->first();

        if (!$faculty) {
            return redirect()->back()->with('error', 'Faculty not found');
        }

        $faculty->update([
            'ReasonForArchiving' => $request->reason,
            'ArchivedBy' => auth()->user()->id,
        ]);

        if (!$faculty->delete()) {
            return redirect()->back()->with('error', 'There was a problem deleting the faculty.');
        }

        return redirect()->route('faculties.index')->with('success', 'Faculty successfully deleted!');

    }

}
