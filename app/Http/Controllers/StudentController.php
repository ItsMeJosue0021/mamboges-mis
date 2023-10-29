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

        // $current_school_year = SchoolYear::where('is_current', true)->first();


        return view('student.show', [
            'student' => $student,
        ]);
    }


    public function store(StoreStudentRequest $request) 
    {
        $data = $request->validated();

        $existingStudentAccount = User::where('username', $data['lrn'])->first();
        $existingStudent = Student::where('lrn', $data['lrn'])->first();

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

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $guardian = Guardian::find($student->parent_id);

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }

        $lrn = $request->lrn;
        $existingStudent = Student::where('lrn', $lrn)->where('id', '!=', $id)->where('is_archived', false)->first();

        if ($existingStudent) {
            return response()->json(['success' => false, 'message' => 'LRN is already assigned to another student']);
        }

        $email = $request->email;
        $existingEmail = Guardian::where('email', $email)
            ->where('id', '!=', $student->parent_id)
            ->first();

        if ($existingEmail) {
            return response()->json(['success' => false, 'message' => 'The same email is already registered']);
        }

        $studentGuardian = [
            'first_name' => $request->parent_first_name,
            'last_name' => $request->parent_last_name,
            'middle_name' => $request->parent_middle_name,
            'suffix' => $request->parent_suffix,
            'sex' => $request->parent_sex,
            'email' => $request->email,
            'contact_no' => $request->parent_contact_no,
            'address' => $request->address,
        ];

        $guardian->update($studentGuardian);

        $current_school_year = SchoolYear::where('is_current', true)->first();

        if (!is_null($guardian)) {
            $studentArray = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'suffix' => $request->suffix,
                'sex' => $request->sex,
                'lrn' => $request->lrn,
                'dob' => $request->dob,
                'address' => $request->address,
                'parent_id' => $guardian->id,
            ];

            if ($request->hasFile('image')) {
                $studentArray['image'] = $request->file('image')->store('profile', 'public');
            }

            $student->update($studentArray);

            if ($student->wasChanged() || $guardian->wasChanged()) {

                $studUserAccount = User::where('username', $student->lrn)->first();

                $studentAccount = [
                    'name' => $request->first_name . " " . $request->last_name . " " . $request->middle_name,
                    'username' => $request->lrn,
                    'password' => Hash::make($request->lrn),
                ];

                if ($request->hasFile('image')) {
                    $studentAccount['image'] = $request->file('image')->store('profile', 'public');
                }

                $studUserAccount->update($studentAccount);

                Logs::addToLog('Student information has been altered | LRN [' . $student->lrn . ']');
                return response()->json(['success' => true, 'message' => 'Student information has been updated']);
            } else {
                Logs::addToLog('Failed to alter student information | LRN [' . $student->lrn . ']');
                return response()->json(['success' => false, 'message' => 'Nothing was changed']);
            }
        } else {
            Logs::addToLog('Failed to alter the gaurdian and student information');
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful, please check the details of Guardian']);
        }
    }

    public function delete(Request $request, $id)
    {

        $student = Student::where('id', $id)->first();

        $lastClassAttended = SectionStudents::where('student_id', $student->id)->latest()->first();

        $grade_level = null;
        $section = null;

        if (!is_null($lastClassAttended)) {
            $grade_level = $lastClassAttended->grade_level;
            $section = $lastClassAttended->section_id;
        }

        if ($student) {
            $toBeArchived = [
                'student_id' => $student->id,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'middle_name' => $student->middle_name,
                'suffix' => $student->suffix,
                'sex' => $student->sex,
                'lrn' => $student->lrn,
                'dob' => $student->dob,
                'address' => $student->address,
                'grade_level' => $grade_level,
                'reason' => $request->reason,
                'image' => $student->image,
                'section_id' => $section,
                'parent_id' => $student->parent_id,
            ];

            $archivedStudent = ArchivedStudents::create($toBeArchived);

            if (!is_null($archivedStudent)) {

                $studentDeleted = $student->delete();

                // $lastClassAttendedDeleted = $lastClassAttended->delete();

                if ($lastClassAttended) {
                    $lastClassAttendedDeleted = $lastClassAttended->delete();
                } else {
                    $lastClassAttendedDeleted = true; // If $lastClassAttended is null, consider it as deleted.
                }

                if ($studentDeleted && $lastClassAttendedDeleted) {

                    Logs::addToLog('Student has been moved to archive | LRN [' . $student->lrn . ']');

                    return response()->json(['success' => true, 'message' => 'Student deleted successfully']);

                } else {
                    return response()->json(['success' => false, 'message' => 'Unable to delete student']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Something went wrong']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Student not found.']);
        }

    }

}
