<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Logs;
use App\Models\Grade;
use App\Models\Address;
use App\Models\Profile;
use App\Models\Section;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Models\ArchivedStudents;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $current_school_year = SchoolYear::where('is_current', true)->first();

        if ($request->grade_level) {
            $enrolledStudents = Student::where('isEnrolled', true)->get();

            $collection = collect([]);

            foreach ($enrolledStudents as $student) {
                $rightGradeLevel = $student->sectionStudents->where('school_year_id', $current_school_year->id)->first()
                    ->section->gradeLevel == $request->grade_level;

                if ($rightGradeLevel) {
                    $collection->push($student);
                }
            }

            $students = $this->paginator($collection, $request);

        } elseif ($request->search) {

            $collection = collect([]);

            foreach (Student::all() as $student) {
                if (
                    $student->lrn == $request->search ||
                    strcasecmp($student->user->profile->lastName, $request->search) == 0 ||
                    strcasecmp($student->user->profile->firstName, $request->search) == 0 ||
                    strcasecmp($student->user->profile->middleName, $request->search) == 0 ||
                    strcasecmp($student->user->profile->address->barangay, $request->search) == 0 ||
                    strcasecmp($student->user->profile->address->city, $request->search) == 0
                ) {
                    $collection->push($student);
                }
            }

            $students = $this->paginator($collection, $request);

        } else {
            $students = Student::latest()->paginate(20);
        }

        return view('student.index', [
            'students' => $students,
            'totalLearners' => Student::count(),
            'resultCount' => $students->count(),
        ]);
    }

    public function paginator($collection, $request)
    {
        $perPage = 20;
        $page = request('page', 1);
        $students = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => route('student.index', ['grade_level' => $request->grade_level])]
        );

        return $students;
    }

    public function create()
    {
        return view('student.create');
    }


    public function show(Student $student)
    {
        $student = Student::withTrashed()->find($student->id);

        if ($student->isEnrolled) {
            $current_school_year = SchoolYear::where('is_current', true)->first();
            $section = $student->sectionStudents->where('school_year_id', $current_school_year->id)->first()->section;
        }

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $currentSection = $student->sectionStudents->where('school_year_id', $current_school_year->id)->first();

        $grades = Grade::where('student_id', $student->id)->get();

        return view('student.show', [
            'student' => $student,
            'section' => $currentSection->section ?? null,
            'classes' => $student->sectionStudents,
            'grades' => $grades,
            'school_year' => $current_school_year,
        ]);

    }


    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        $existingStudentAccount = User::where('username', $data['lrn'])->first();
        $existingStudent = Student::withTrashed()->where('lrn', $data['lrn'])->first();
        $emailExist = User::where('email', $data['parentsEmail'])->first();

        if ($emailExist) {
            return redirect()->back()->with('error', 'Email address is already assigned to another student');
        }

        if ($existingStudentAccount || $existingStudent) {
            return redirect()->back()->with('error', 'LRN is already assigned to another student');
        }

        $studentAccount = User::create([
            'email' => $data['parentsEmail'],
            'username' => $data['lrn'],
            'password' => Hash::make($data['lastName']),
        ]);

        if ($studentAccount) {

            $guardianData = [
                'firstName' => $data['parentsFirstName'],
                'lastName' => $data['parentsLastName'],
                'middleName' => $data['parentsMiddleName'],
                'suffix' => $data['parentsSuffix'],
                'dob' => $data['parentsDob'],
                'sex' => $data['parentsSex'],
                'contactNumber' => $data['parentsContactNumber'],
                'user_id' => null,
            ];

            $guardianProfile = Profile::create($guardianData);

            $guardian = Guardian::create([
                'profile_id' => $guardianProfile->id
            ]);

            if ($guardian) {
                $student = Student::create([
                    'lrn' => $data['lrn'],
                    'user_id' => $studentAccount->id,
                    'guardian_id' => $guardian->id,
                ]);

                if ($student) {
                    $studentData = [
                        'firstName' => $data['firstName'],
                        'lastName' => $data['lastName'],
                        'middleName' => $data['middleName'],
                        'suffix' => $data['suffix'],
                        'dob' => $data['dob'],
                        'sex' => $data['sex'],
                        'contactNumber' => $data['contactNumber'],
                        'image' => $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : null,
                        'user_id' => $studentAccount->id,
                    ];
                    $studentProfile = Profile::create($studentData);

                    Address::create([
                        'lot' => $data['lot'],
                        'block' => $data['block'],
                        'street' => $data['street'],
                        'subdivision' => $data['subdivision'],
                        'barangay' => $data['barangay'],
                        'city' => $data['city'],
                        'province' => $data['province'],
                        'zipCode' => $data['zipCode'],
                        'profile_id' => $studentProfile->id
                    ]);
                    return redirect()->back()->with('success', 'Student successfully added!');
                }
            }

        } else {
            return redirect()->back()->with('error', 'There was a problem creating the student account.');
        }
    }

    public function edit(Student $student)
    {
        return view('student.edit', [
            'student' => $student,
        ]);
    }

    public function update(UpdateStudentRequest $request, $studentId)
    {

        // dd($request->all());
        $data = $request->validated();

        $student = Student::find($studentId);

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        // if (isset($data['parentsEmail'])) {

        //     $user = User::where('email', $data['parentsEmail'])->first();

        //     if ($user) {
        //         return redirect()->back()->with('error', 'Email is already assigned to another student');
        //     } else {
        //         $student->user->update([
        //             'email' => $data['parentsEmail']
        //         ]);
        //     }
        // }

        $studentUpdted = $student->user->profile->update([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'middleName' => $data['middleName'],
            'suffix' => $data['suffix'],
            'dob' => $data['dob'],
            'sex' => $data['sex'],
            'contactNumber' => $data['contactNumber'],
            'image' => $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : $student->user->profile->image,
        ]);

        if (!$studentUpdted) {
            return redirect()->back()->with('error', 'There was a problem updating the student profile.');
        }

        $guardianProfileInfo = [
            'firstName' => $data['parentsFirstName'],
            'lastName' => $data['parentsLastName'],
            'middleName' => $data['parentsMiddleName'],
            'suffix' => $data['parentsSuffix'],
            'dob' => $data['parentsDob'],
            'sex' => $data['parentsSex'],
            'contactNumber' => $data['parentsContactNumber']
        ];

        if (is_null($student->guardian)) {
            $guardianCreated = Profile::create($guardianProfileInfo);
            $guardianUpdated = Guardian::create([
                'profile_id' => $guardianCreated->id
            ]);
            $student->guardian_id = $guardianUpdated->id;
            $student->save();
        } else {
            $guardianUpdated = $student->guardian->profile->update($guardianProfileInfo);
        }

        if (!$guardianUpdated) {
            return redirect()->back()->with('error', 'There was a problem updating the guardian profile.');
        }

        $lrnUpdated = $student->update([
            'lrn' => $data['lrn']
        ]);

        if (!$lrnUpdated) {
            return redirect()->back()->with('error', 'There was a problem updating the LRN.');
        }

        $addressUpdated = $student->user->profile->address->update([
            'lot' => $data['lot'],
            'block' => $data['block'],
            'street' => $data['street'],
            'subdivision' => $data['subdivision'],
            'barangay' => $data['barangay'],
            'city' => $data['city'],
            'province' => $data['province'],
            'zipCode' => $data['zipCode'],
        ]);

        if (!$addressUpdated) {
            return redirect()->back()->with('error', 'There was a problem updating the address.');
        }
        return redirect()->back()->with('success', 'Student information successfully updated!');
    }

    public function archivingInfo(Student $student)
    {
        return view('student.delete', [
            'student' => $student
        ]);
    }

    public function delete(Request $request, $studentId)
    {

        $student = Student::find($studentId);

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        $student->update([
            'ReasonForArchiving' => $request->reason,
            'ArchivedBy' => auth()->user()->id,
            'lastSectionAttended' => $student->sectionStudents->first()->section->name ?? null,
            'gradeLevelWhenArchived' => $student->sectionStudents->first()->section->gradeLevel ?? null,
        ]);

        if (!$student->delete()) {
            return redirect()->back()->with('error', 'There was a problem deleting the student.');
        }

        foreach ($student->sectionStudents as $sectionStudent) {
            $sectionStudent->delete();
        }

        return redirect()->route('student.index')->with('success', 'Student successfully deleted!');
    }
}
