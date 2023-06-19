<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Logs;
use App\Models\Faculty;
use App\Models\Section;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Subjects;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SectionStudents;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SectionController extends Controller
{
    // Show All Sections -------------------------------------------------------------------------------------------------------------------------
    public function index() {

        $sections_all = Section::all();

        $sections = Section::where('is_archived', false)
        ->orderBy('grade_level')->filter(Request(['search']))
        ->get();

        $advisers = Faculty::whereNotNull('id')
        ->whereIn('id', $sections_all->pluck('adviser_faculty_id')->unique())
        ->get()
        ->keyBy('id');

        $teachers = Faculty::whereNotIn('id', $advisers->keys())
        ->orderBy('last_name')
        ->get();

        $all_teachers = Faculty::whereNotNull('id')->get();
        
        return view('sections.index', compact('sections', 'advisers', 'teachers', 'all_teachers'));
    }

    // Search Students -------------------------------------------------------------------------------------------------------------------------
    public function searchStudents(Request $request, $section_id)
    {
        $search = $request->input('search');
        $grade_level = $request->input('grade_level');

        $all_students = Student::where('is_archived', false)->filter(Request(['search', 'grade_level']))->get();

        return view('students.search', [
            'all_students' => $all_students
        ])->render();
    }

    // Show Section Details -------------------------------------------------------------------------------------------------------------------------
    public function show(Section $section) {
        
        $sections_all = Section::where('is_archived', false)->get();

        $students = Student::where('section_id', $section->id)->where('is_archived', false)->get();

        $all_students = Student::where('is_archived', false)->filter(Request(['search', 'grade_level']))->get();

        $studentsCount = $students->count();

        $faculties = Faculty::where('is_archived', false)->get();

        $subjects = Subjects::where('is_archived', false)->get();

        $advisers = Faculty::whereNotNull('id')
        ->where('is_archived', false)
        ->whereIn('id', $sections_all->pluck('adviser_faculty_id')->unique())
        ->get()
        ->keyBy('id');

        $schoolYear = SchoolYear::where('is_current', true)->first();

        return view('sections.show', [
            'section' => $section,
            'adviser' => $advisers,
            'students' => $students,
            'studentCount' => $studentsCount,
            'school_year' => $schoolYear,
            'all_students' => $all_students,
            'faculties' => $faculties,
            'subjects' => $subjects
        ]);
    }

    public function getSection($id)
    {
        $section = Section::findOrFail($id);
        return response()->json($section);
    }


    // Create Scetion -------------------------------------------------------------------------------------------------------------------------
    public function store(Request $request) {
        $adviserId = $request->adviser;
        $adviserAlreadyTaken = Section::where('adviser_faculty_id', $adviserId)->exists();
        $sectionAlreadyTaken = Section::where('name', $request->name)->exists();
    
        if ($adviserAlreadyTaken) {
            $adviserId = null;
        }
    
        if ($sectionAlreadyTaken) {
            $request->name = null;
        }

        $current_school_year = SchoolYear::where('is_current', true)->first();
    
        $sectionArray = array (
            'name' => $request->name,
            'grade_level' => $request->grade_level,
            'school_year_id' => $current_school_year->id,
            'adviser_faculty_id' => $adviserId
        );
    
        $section = Section::create($sectionArray);
    
        if (!is_null($section)) {
            Logs::addToLog('New section has been created | SECTION [' . $section->name . ']');
            return response()->json(['success' => true, 'message' => 'The Section has been saved!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Saving unsuccessful!']);
        }
    }
     

    // Update Section -------------------------------------------------------------------------------------------------------------------------
    public function update(Request $request, $id) {
        $section = Section::find($id);
        $sectionBefore = Section::find($id);
        if (!$section) {
            return response()->json(['success' => false, 'message' => 'Section not found.']);
        }
    
        $existingSection = Section::where('name', $request->name)
        ->where('id', '<>', $id)
        ->first();

        if ($existingSection) {
            return response()->json(['success' => false, 'message' => 'The section name is already taken.']);
        }
    
        $existingAdviser = Section::where('adviser_faculty_id', $request->adviser)
        ->where('id', '<>', $id)
        ->first();
        
        if ($existingAdviser) {
            return response()->json(['success' => false, 'message' => 'The adviser is already assigned to another section.']);
        }
    
        $section->name = $request->name;
        // $section->grade_level = $request->grade_level;
        $section->adviser_faculty_id = $request->adviser;
    
        if ($section->save()) {
            Logs::addToLog('Section has been updated | from: [' . $sectionBefore->name . '] [' . $sectionBefore->adviser_faculty_id . '] to [' . $request->name . '] [' . $request->adviser . ']');
            return response()->json(['success' => true, 'message' => 'The Section has been updated!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Updating unsuccessful!']);
        }
    }   

    // Delete Section -------------------------------------------------------------------------------------------------------------------------
    public function delete($id)
    {
        $current_school_year = SchoolYear::where('is_current', true)->first();

        $section = Section::find($id);

        $sectionStudents = SectionStudents::where('section_id', $id)->where('school_year_id', $current_school_year->id)->get();

        if ($sectionStudents->count() > 0) {
            foreach ($sectionStudents as $sectionStudent) {

                $student = Student::where('id', $sectionStudent->student_id)->first();

                $student->grade_level = 'unenrolled';
                $student->section_id = null;
                $editedStudent = $student->save();

                $sectionStudent->delete();
            }
        }

        $sectionDeleted = $section->delete();

        if ($sectionDeleted) {
            Logs::addToLog('Section has been deleted | SECTION [' . $section->name . ']');
            return response()->json(['success' => true, 'message' => 'Section deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Section not found.']);
        }
        
    }

    // Add Students -------------------------------------------------------------------------------------------------------------------------
    public function addStudent(Request $request, Section $section) {
    
        $lrn = $request->lrn;
        $existingStudent = Student::where('lrn', $lrn)->first();

        if ($existingStudent) {
            return response()->json(['success' => false, 'message' => 'LRN is already assigned to another student']);
        }

        $email = $request->email;
        $existingEmail = Guardian::where('email', $email)->first();

        if ($existingEmail) {
            return response()->json(['success' => false, 'message' => 'The same email is alredy registered']);
        }

        $studentGuardian = array (
            'first_name' => $request->parent_first_name,
            'last_name' => $request->parent_last_name,
            'middle_name' => $request->parent_middle_name,
            'suffix' => $request->parent_suffix,
            'sex' => $request->parent_sex,
            'email' => $request->email,
            'contact_no' => $request->parent_contact_no,
            'address' => $request->address,
        );

        $guardian = Guardian::create($studentGuardian);

        if (!is_null($guardian)) {
            $studentArray = array (
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'suffix' => $request->suffix,
                'sex' => $request->sex,
                'lrn' => $request->lrn,
                'dob' => $request->dob,
                'address' => $request->address,
                'grade_level' => $section->grade_level,
                'section_id' => $section->id,
                'parent_id' => $guardian->id
            );
    
            $studentAccount = array (
                'name' => $request->first_name . " " . $request->last_name . " " . $request->middle_name,
                'username' => $request->lrn,
                'password' => Hash::make($request->lrn),
            );
        
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

    // Search Students -------------------------------------------------------------------------------------------------------------------------
    public function searchStudent(Request $request)
    {
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
                    ->get();
                    
            } else {
                $data = Student::where('is_archived', false)
                    ->orderBy('id', 'desc')
                    ->get();
            }
             
            $total_row = $data->count();
            if($total_row > 0){
                foreach($data as $row)
                {
                    $output .= '
                    <div class="flex justify-between space-x-6 px-2 py-2 border-t border-gray-300" >
                        <div class="flex space-x-2">
                            <p class="poppins text-base text-gray-700">'.$row->first_name.'</p>
                            <p class="poppins text-base text-gray-700">'.$row->last_name.'</p>
                            <p class="poppins text-base text-gray-700">'.$row->middle_name.'</p>
                        </div>
                        <div id="button-container">
                            <button id="'.$row->id.'" class="addstudentbtn poppins text-xs text-blue-500 py-1 px-2 rounded border border-blue-500 hover:bg-blue-500 hover:text-white">enroll</button>
                        </div>
                    </div>
                    ';
                }
            } else {
                $output = '
                <div>
                    <p class="poppins text-red-500 text-sm text-center">No Data Found</p>
                </div>
                ';
            }
            $data = array(
                'student_data'  => $output
            );
            echo json_encode($data);
        }
    }

}


