<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
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
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '') {
                $data = Student::where('first_name', 'like', '%'.$query.'%')
                    ->orWhere('last_name', 'like', '%'.$query.'%')
                    ->orWhere('middle_name', 'like', '%'.$query.'%')
                    ->orWhere('suffix', 'like', '%'.$query.'%')
                    ->orWhere('lrn', 'like', '%'.$query.'%')
                    ->where('is_archived', false)
                    ->orderBy('id', 'desc')
                    ->paginate(50);
                    
            } else {
                $data = Student::where('is_archived', false)
                    ->orderBy('id', 'desc')
                    ->paginate(50);
            }
             
            $total_row = $data->total();
            if($total_row > 0){
                foreach($data as $row)
                {
                    $sections = Section::where('is_archived', false)->get();

                    $output .= '
                        <a class="w-full group flex items-center hover:bg-blue-50"  href="/students/'.$row->id.'"> 
                            <div class="w-full flex justify-between py-2 px-4 border-b border-gray-300 group-hover:border-blue-300 items-center">
                                <p class="w-full poppins text-base group-hover:text-blue-500">
                                '.$row->first_name.' '.$row->middle_name.' '.$row->last_name.'
                                </p>
                                <p class="w-full poppins text-center text-base group-hover:text-blue-500">'.$row->sex.' </p>
                                <p class="w-full poppins text-end text-base group-hover:text-blue-500">'.$row->lrn.' </p>
                            </div>
                        </a>
                    ';

                }

                $output .= '<div class="pagination my-5">' . $data->links() . '</div>';

            } else {
                $output = '
                <div class="w-full h-96 flex flex-col items-center justify-center mt-20">
                    <p class="poppins text-xl  text-red-500 mt-5">Oops! No student found.</p>
                </div>
                ';
            }
            $data = array(
                'student_data'  => $output
            );
            echo json_encode($data);
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

    public function dashboard() {
        return view('student.dashboard');
    }

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
                'grade_level' => $request->grade_level,
                'parent_id' => $guardian->id,
                // 'school_year_id' => $current_school_year->id
            ];
    
            $studentAccount = [
                'name' => $request->first_name . " " . $request->last_name . " " . $request->middle_name,
                'username' => $request->lrn,
                'password' => Hash::make($request->lrn),
            ];
        
            $student = Student::create($studentArray);
            
            $account = User::create($studentAccount);

            if (!is_null($student) && !is_null($account)) {
                return response()->json(['success' => true, 'message' => 'Student has been saved!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Saving unsuccessful!']);
            }
        } else {
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
                'grade_level' => $request->grade_level,
                'parent_id' => $guardian->id,
                // 'school_year_id' => $current_school_year->id
            ];
    
            $student->update($studentArray);
    
            if ($student->wasChanged()) {
                return response()->json(['success' => true, 'message' => 'Student information has been updated']);
            } else {
                return response()->json(['success' => false, 'message' => 'Nothing was changed']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful, please check the details of Guardian']);
        }
    }

    public function delete($id) {
        $student = Student::find($id);
        if ($student) {
            $student->is_archived = true;
            $student->save();
            return response()->json(['success' => true, 'message' => 'Student deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Section not found.']);
        }
    }
    

    public function import() {

    }
}
