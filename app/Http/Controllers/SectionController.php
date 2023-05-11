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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SectionController extends Controller
{
    // show all scetion
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

    public function searchStudents(Request $request, $section_id)
    {
        $search = $request->input('search');
        $grade_level = $request->input('grade_level');

        $all_students = Student::where('is_archived', false)->filter(Request(['search', 'grade_level']))->get();

        return view('students.search', [
            'all_students' => $all_students
        ])->render();
    }

    // show section details
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


    //create section
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
     

    //update section
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
        $section->grade_level = $request->grade_level;
        $section->adviser_faculty_id = $request->adviser;
    
        if ($section->save()) {
            Logs::addToLog('Section has been updated | from: [' . $sectionBefore->name . '] [' . $sectionBefore->grade_level . '] [' . $sectionBefore->adviser_faculty_id . '] to [' . $request->name . '] [' . $request->grade_level . '] [' . $request->adviser . ']');
            return response()->json(['success' => true, 'message' => 'The Section has been updated!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Updating unsuccessful!']);
        }
    }   

    public function delete($id)
    {
        $section = Section::find($id);
        if ($section) {
            $section->is_archived = true;
            $section->save();
            Logs::addToLog('Section has been deleted | SECTION [' . $section->name . ']');
            return response()->json(['success' => true, 'message' => 'Section deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Section not found.']);
        }
    }

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
                    // ->where('section_id', null)
                    ->orderBy('id', 'desc')
                    ->get();
                    
            } else {
                $data = Student::where('is_archived', false)
                    // ->where('section_id', null)
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

// public function show(Section $section) {
    //     $sections_all = Section::where('is_archived', false)->get();
    
    //     $students = Student::where('section_id', $section->id)->where('is_archived', false)->get();
    
    //     $search = request('search');
    //     $grade_level = request('grade_level');
    
    //     $all_students_query = Student::where('is_archived', false);
    
    //     if ($search) {
    //         $all_students_query->where(function($query) use ($search) {
    //             $query->where('first_name', 'like', '%'.$search.'%')
    //                   ->orWhere('last_name', 'like', '%'.$search.'%')
    //                   ->orWhere('middle_name', 'like', '%'.$search.'%');
    //         });
    //     }
    
    //     if ($grade_level) {
    //         $all_students_query->where('grade_level', $grade_level);
    //     }
    
    //     $all_students = $all_students_query->get();
    
    //     $studentsCount = $students->count();
    
    //     $advisers = Faculty::whereNotNull('id')
    //         ->where('is_archived', false)
    //         ->whereIn('id', $sections_all->pluck('adviser_faculty_id')->unique())
    //         ->get()
    //         ->keyBy('id');
    
    //     $schoolYear = SchoolYear::where('is_current', true)->first();
    
    //     return view('sections.show', [
    //         'section' => $section,
    //         'adviser' => $advisers,
    //         'students' => $students,
    //         'studentCount' => $studentsCount,
    //         'school_year' => $schoolYear,
    //         'all_students' => $all_students,
    //     ]);
    // }

    // public function importStudent(Request $request, Section $section) {
    //     $file = $request->file('csv');
    //     $csvData = file_get_contents($file);
    //     $rows = array_map('str_getcsv', explode("\n", $csvData));
    //     $success = true;

    //     foreach ($rows as $row) {
    //         if (count($row) >= 15) {
    //             $first_name = $row[0];
    //             $last_name = $row[1];
    //             $middle_name = $row[2];
    //             $suffix = $row[3];
    //             $sex = $row[4];
    //             $lrn = $row[5];
    //             $dob = $row[6];
    //             $parent_fname = $row[7];
    //             $parent_lname = $row[8];
    //             $parent_mname = $row[9];
    //             $parent_suffix = $row[10];
    //             $parent_sex = $row[11];
    //             $email = $row[12];
    //             $contact_no = $row[13];
    //             $address = $row[14];

    //             $existingEmail = Guardian::where('email', $email)->first();

    //             $studentGuardian = [
    //                 'first_name' => $parent_fname,
    //                 'last_name' => $parent_lname,
    //                 'middle_name' => $parent_mname,
    //                 'suffix' => $parent_suffix,
    //                 'sex' => $parent_sex,
    //                 'email' => $existingEmail ? null : $email,
    //                 'contact_no' => $contact_no,
    //                 'address' => $address,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ];
        
    //             $guardian = Guardian::create($studentGuardian);

    //             $date = Carbon::createFromFormat('d/m/Y', $dob);

    //             $formattedDate = $date->format('Y-m-d');

    //             $existinglrn = Student::where('lrn', $lrn)->first();

    //             if (!is_null($guardian)) {
    //                 $studentArray = [
    //                     'first_name' => $first_name,
    //                     'last_name' => $last_name,
    //                     'middle_name' => $middle_name,
    //                     'suffix' => $suffix,
    //                     'sex' => $sex,
    //                     'lrn' => $existinglrn ? null : $lrn,
    //                     'dob' => $formattedDate,
    //                     'address' => $address,
    //                     'grade_level' => $section->grade_level,
    //                     'section_id' => $section->id,
    //                     'parent_id' => $guardian->id,
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ];

    //                 $datePassword = $date->format('Y m d');
    //                 $password = $last_name . $datePassword;
    //                 $studentAccount = [
    //                     'name' => $first_name . " " . $last_name . " " . $middle_name,
    //                     'username' => $existinglrn ? $last_name : $lrn,
    //                     'password' => Hash::make($password),
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ];
                
    //                 $student = Student::create($studentArray);
                    
    //                 $account = User::create($studentAccount);
        
    //             } else {
    //                 return response()->json(['success' => false, 'message' => 'Saving unsuccessful, please check the details of Guirdian.']);
    //             }
    //         } 
    //     }

    //     if (!is_null($student) && !is_null($account)) {
    //         return response()->json(['success' => true, 'message' => 'Student has been saved!']);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Saving unsuccessful!']);
    //     }
    // }


    //import csv file to add multiple sections at once
    // public function import(Request $request)
    // {
    //     $file = $request->file('csv');
    //     $csvData = file_get_contents($file);
    //     $rows = array_map('str_getcsv', explode("\n", $csvData));
    //     $success = true;

    //     foreach ($rows as $row) {
    //         if (count($row) >= 4) {
    //             $sectionName = $row[0];
    //             $gradeLevel = $row[1];
    //             $schoolYear = $row[2];
    //             $adviserFirstName = $row[3];
    //             $adviserLastName = $row[4];

    //             // Check if section already exists
    //             $existingSection = DB::table('sections')
    //             ->where('name', $sectionName)
    //             ->first();

    //             // Check if adviser already exists in sections table
    //             $adviser = null;
    //             if (!empty($adviserFirstName) && !empty($adviserLastName)) {
    //                 $faculty = DB::table('faculties')
    //                 ->where('first_name', $adviserFirstName)
    //                 ->where('last_name', $adviserLastName)
    //                 ->first();

    //                 if ($faculty) {
    //                     $existingAdviser = DB::table('sections')
    //                     ->where('adviser', $faculty->id)
    //                     ->first();

    //                     if ($existingAdviser) {
    //                         $adviser = null;
    //                     } else {
    //                         $adviser = $faculty->id;
    //                     }
    //                 }
    //             }

    //             if ($existingSection || $adviser === null) {
    //                 // If section already exists or adviser is null, insert the section without name or adviser
    //                 $inserted = DB::table('sections')->insert([
    //                     'name' => $existingSection ? null : $sectionName,
    //                     'grade_level' => $gradeLevel,
    //                     'school_year' => $schoolYear,
    //                     'adviser' => $adviser,
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ]);

    //                 if (!$inserted) {
    //                     $success = false;
    //                 }
    //             } else {
    //                 // If section doesn't exist and adviser is not null, insert the section with name and adviser
    //                 $inserted = DB::table('sections')->insert([
    //                     'name' => $sectionName,
    //                     'grade_level' => $gradeLevel,
    //                     'school_year' => $schoolYear,
    //                     'adviser' => $adviser,
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ]);

    //                 if (!$inserted) {
    //                     $success = false;
    //                 }
    //             }
    //         }
    //     }

    //     if ($success) {
    //         return response()->json(['success' => true, 'message' => 'CSV file imported successfully.']);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Error occurred while importing CSV file.']);
    //     }
    // }


    // public function index()
    // {
    //     $sections_all = Section::all();
    //     $sections = Section::where('is_archived', false)
    //     ->orderBy('grade_level')
    //     ->get();

    //     $advisers = Faculty::whereNotNull('id')
    //     ->whereIn('id', $sections_all->pluck('adviser_faculty_id')->unique())
    //     ->get()
    //     ->keyBy('id');

    //     $teachers = Faculty::whereNotIn('id', $advisers->keys())
    //     ->orderBy('last_name')
    //     ->get();

    //     $data = [
    //         'sections' => $sections->toJson(),
    //         'advisers' => $advisers->toJson(),
    //         'teachers' => $teachers->toJson(),
    //     ];
    //     return view('sections.index', compact('data'));
    // }

    // show edit form
    // public function edit(Section $section) {

    //     $sections = Section::orderBy('grade_level')->get();

    //     $advisers = Faculty::whereNotNull('id')
    //     ->whereIn('id', $sections->pluck('adviser')->unique())
    //     ->get()
    //     ->keyBy('id');

    //     $teachers = Faculty::whereNotNull('id')->get();

    //     return view('sections.edit', [
    //         'sections' => $section,
    //         'teachers' => $teachers,
    //     ]);
    // }   

