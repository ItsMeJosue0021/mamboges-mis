<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Logs;
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
                    $student->user->profile->lastName == $request->search ||
                    $student->user->profile->firstName == $request->search ||
                    $student->user->profile->middleName == $request->search ||
                    $student->user->profile->address->barangay == $request->search ||
                    $student->user->profile->address->city == $request->search
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
        if ($student->isEnrolled) {
            $current_school_year = SchoolYear::where('is_current', true)->first();
            $section = $student->sectionStudents->where('school_year_id', $current_school_year->id)->first()->section;
        }

        return view('student.show', [
            'student' => $student ?? 'null',
            'section' => $section ?? 'null',
        ]);
    }


    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        $existingStudentAccount = User::where('username', $data['lrn'])->first();
        $existingStudent = Student::withTrashed()->where('lrn', $data['lrn'])->first();

        if ( $existingStudentAccount || $existingStudent) {
            return redirect()->back()->with('error', 'LRN is already assigned to another student');
        }

        $studentAccount = User::create([
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

    public function edit(Student $student) {
        return view('student.edit', [
            'student' => $student,
        ]);
    }

    public function update(UpdateStudentRequest $request, $studentId)
    {
        $data = $request->validated();

        $student = Student::find($studentId);

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

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

        $guardianUpdated = $student->guardian->profile->update([
            'firstName' => $data['parentsFirstName'],
            'lastName' => $data['parentsLastName'],
            'middleName' => $data['parentsMiddleName'],
            'suffix' => $data['parentsSuffix'],
            'dob' => $data['parentsDob'],
            'sex' => $data['parentsSex'],
            'contactNumber' => $data['parentsContactNumber']
        ]);

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

    public function archivingInfo(Student $student) {
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
        ]);

        if (!$student->delete()) {
            return redirect()->back()->with('error', 'There was a problem deleting the student.');
        }

        return redirect()->route('student.index')->with('success', 'Student successfully deleted!');
    }
}
