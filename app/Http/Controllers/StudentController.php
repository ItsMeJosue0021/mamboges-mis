<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Logs;
use App\Models\Section;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use App\Models\ArchivedStudents;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index() {

        $students = Student::orderBy('grade_level')->filter(Request(['search']))->where('is_archived', false)->get();

        $sections = Section::where('is_archived', false)->get();

        return view('student.index', [
            'students' => $students,
            'sections' => $sections,
        ]);
    }

    public function getStudents(Request $request) {

        $current_school_year = SchoolYear::where('is_current', true)->first();

        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            $gradeLevel = $request->get('grade_level');

            if($query != '') {
                $data = Student::where('is_archived', false)
                    ->where('first_name', 'like', '%'.$query.'%')
                    ->orWhere('last_name', 'like', '%'.$query.'%')
                    ->orWhere('middle_name', 'like', '%'.$query.'%')
                    ->orWhere('suffix', 'like', '%'.$query.'%')
                    ->orWhere('lrn', 'like', '%'.$query.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(10);
                    
            } elseif (!empty($gradeLevel)) {

                $sectionStudents = SectionStudents::where('grade_level', $gradeLevel)
                    ->where('school_year_id', $current_school_year->id)
                    ->get();

                $studentIds = $sectionStudents->pluck('student_id')->toArray();

                $data = Student::where('is_archived', false)
                    ->whereIn('id', $studentIds)
                    ->orderBy('id', 'desc')
                    ->paginate(10);

            } else {

                // $sectionStudents = SectionStudents::where('school_year_id', $current_school_year->id)
                // ->get();

                // $studentIds = $sectionStudents->pluck('student_id')->toArray();

                // $data = Student::where('is_archived', false)
                // ->whereIn('id', $studentIds)
                // ->orderBy('id', 'desc')
                // ->paginate(10);

                $data = Student::where('is_archived', false)
                ->orderBy('id', 'desc')
                ->paginate(10);
            }
             
            $total_row = $data->total();

            if ($total_row > 0) {
                foreach($data as $row)
                {
                    $sections = Section::where('is_archived', false)->get();

                    $imageURL = '';
                    if (!is_null($row->image)) {
                        $imageURL = 'storage/' . $row->image;
                    } else {
                        if ($row->sex == 'Male') {
                            $imageURL = 'image/male.png';
                        } else {
                            $imageURL = 'image/female.png';
                        }
                    }

                    $output .= '
                        <a class="p-2 lg:w-1/3 md:w-1/2 w-full" href="/students/'.$row->id.'">
                            <div class="h-full flex items-center border-gray-200 hover:border-gray-400 hover:shadow border p-4 rounded-lg">
                                <div class="w-12 h-12 bg-gray-100 rounded-full mr-4 border border-gray-400">
                                    <img class="w-full h-full" src="' . $imageURL . '">
                                </div>
                                <div class="flex-grow">
                                    <h2 class="no-underline poppins text-base text-gray-900 title-font font-medium">'.$row->first_name.' '.$row->middle_name.' '.$row->last_name.'</h2>
                                    <p class="no-underline poppins text-sm text-gray-500">LRN: '.$row->lrn.'</p>
                                </div>
                            </div>
                        </a>    
                    ';
                }

                $pagination = '<div class="my-5">' . $data->links() . '</div>';

            } else {

                $output .= '
                    <div class="p-2 w-full h-96 flex flex-col items-center justify-center mt-20">
                        <p class="poppins text-base  text-red-500 mt-5">Oops! No student found.</p>
                    </div>
                ';

                $pagination = '';
            }

            $allStudents = Student::all();
            $allStudentCount = $allStudents->count();

            $data = array(
                'student_data'  => $output,
                'enrolled' => $total_row,
                'pagination' => $pagination,
                'total' => $allStudentCount
            );

            return response()->json($data);
        }
    }


    public function show(Student $student) {

        $current_school_year = SchoolYear::where('is_current', true)->first();

        $studentSection = SectionStudents::where('student_id', $student->id)->where('school_year_id', $current_school_year->id)->first();

        if (!is_null($studentSection)) {
            $section = Section::where('id', $studentSection->section_id)->where('is_archived', false)->first();
        } else {
            $section = Section::where('id', $student->section_id)->where('is_archived', false)->first();
        }

        $parent = Guardian::where('id', $student->parent_id)->first();
        
        return view('student.show', [
            'student' => $student,
            'section' => $section,
            'parent' => $parent,
            'student_section' => $studentSection
        ]);
    }

    // public function dashboard() {
    //     return view('student.dashboard');
    // }

    public function store(Request $request) {

        $existingStudent = Student::where('lrn', $request->lrn)->where('is_archived', false)->first();

        if ($existingStudent) {
            return response()->json(['success' => false, 'message' => 'LRN is already assigned to another student']);
        }

        $existingEmail = Guardian::where('email', $request->email)->first();

        if ($existingEmail) {
            return response()->json(['success' => false, 'message' => 'The same email is alredy registered']);
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

        $guardian = Guardian::create($studentGuardian);

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
                // 'grade_level' => $request->grade_level,
                'parent_id' => $guardian->id,
            ];

            if ($request->hasFile('image') ) {
                $studentArray['image'] = $request->file('image')->store('profile', 'public');
            }

    
            $studentAccount = [
                'name' => $request->first_name . " " . $request->last_name . " " . $request->middle_name,
                'username' => $request->lrn,
                'password' => Hash::make($request->lrn),
            ];
        

            if ($request->hasFile('image') ) {
                $studentAccount['image'] = $request->file('image')->store('profile', 'public');
            }

            $student = Student::create($studentArray);
            
            $account = User::create($studentAccount);

            if (!is_null($student) && !is_null($account)) {
                Logs::addToLog('New student has been added to the masterlist | LRN [' . $student->lrn . ']');
                return response()->json(['success' => true, 'message' => 'Student has been saved!']);
            } else {
                Logs::addToLog('Failed to add new student');
                return response()->json(['success' => false, 'message' => 'Saving unsuccessful!']);
            }
        } else {
            Logs::addToLog('Failed to add the guradian and new student');
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful, please check the details of Guirdian.']);
        }  
    }

    public function update(Request $request, $id) {
        $student = Student::find($id);
        $guardian = Guardian::find($student->parent_id);
    
        if(!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }
    
        $lrn = $request->lrn;
        $existingStudent = Student::where('lrn', $lrn)->where('id', '!=', $id)->where('is_archived', false)->first();
    
        if ($existingStudent) {
            return response()->json(['success' => false, 'message' => 'LRN is already assigned to another student']);
        }
    
        $email = $request->email;
        $existingEmail = Guardian::where('email', $email)
        ->where('id', '!=', $student->parent_id )
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

            if ($request->hasFile('image') ) {
                $studentArray['image'] = $request->file('image')->store('profile', 'public');
            }
    
            $student->update($studentArray);
    
            if ($student->wasChanged() || $guardian->wasChanged()) {
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

    public function delete(Request $request, $id) {
        
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
