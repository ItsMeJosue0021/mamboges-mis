<?php
use App\Models\SectionStudents;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LrController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UpdatesController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SectionStudentsController;
use App\Http\Controllers\SectionSubjectsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/lr/dashboard', [LrController::class, 'index']);

Route::get('/faculty/dashboard', [FacultyController::class, 'dashboard']);

Route::get('/student/dashboard', [StudentController::class, 'index']);


require __DIR__.'/auth.php';

Route::get('/', [WebsiteController::class, 'index']);

//                        WEBSITE
//home page
Route::get('/', [WebsiteController::class, 'index']);

//                        FEEDBACK

//storing feedback
Route::post('/feedback/save', [FeedbackController::class, 'store']);

//show all feedback
Route::get('/feedback', [FeedbackController::class, 'index']); //only guidance can access this route

//reply feedback
Route::post('/feedback/{feedback}/replyfeedback', [FeedbackController::class, 'reply']);

//show single feedback
Route::get('/feedback/{feedback}', [FeedbackController::class, 'show']); //only guidance can access this route

//change read status of feedback
Route::put('/feedback/{feedback}/read', [FeedbackController::class, 'read']);



//                        UPDATES
//show create update form
Route::get('/updates/create', [UpdatesController::class, 'create']); //only guidance can access this route

//show all updates
Route::get('/updates', [UpdatesController::class, 'index']);

//list of updates
Route::get('updates/list', [UpdatesController::class, 'list']); //only guidance can access this route

//edit update 
Route::put('/updates/{update}/update', [UpdatesController::class, 'update']); //only guidance can access this route

//show single update
Route::get('/updates/{update}', [UpdatesController::class, 'show']);

//save update to database
Route::post('/updates/save', [UpdatesController::class, 'store']); //only guidance can access this route

//show edit updates form
Route::get('/updates/{update}/edit', [UpdatesController::class, 'edit']); //only guidance can access this route

//update feedback
Route::delete('/updates/{update}delete', [UpdatesController::class, 'delete']); //only guidance can access this route


//                        FACULTY
//faculty home page
Route::get('/faculties', [FacultyController::class, 'index']);

Route::post('/faculties/save', [FacultyController::class, 'store']);

Route::get('/faculties/{faculty}', [FacultyController::class, 'show']);

Route::put('/faculties/{faculty}/update', [FacultyController::class, 'update']);

Route::delete('/faculties/{faculty}/delete', [FacultyController::class, 'delete']);



//                        STUDENT

//show all students
Route::get('/students', [StudentController::class, 'index']);

Route::get('/students/search', [StudentController::class, 'getStudents']);

Route::get('/students/{student}', [StudentController::class, 'show']);

Route::put('/students/{student}/edit', [StudentController::class, 'update']);

Route::delete('/students/{student}/delete', [StudentController::class, 'delete']);

//register students
Route::post('/students/register', [StudentController::class, 'store']);



//                           EVALUATION

Route::get('/evaluation', [GradeController::class, 'evaluation']);


//                          SECTIONS

Route::get('/sections', [SectionController::class, 'index']);

Route::get('/sections/search', [SectionController::class, 'searchStudent']);

Route::post('/sections/save', [SectionController::class, 'store']);

Route::post('/sections/import', [SectionController::class, 'import']);

Route::get('/sections/{section}', [SectionController::class, 'show']);

Route::get('/sections/edit/{section}', [SectionController::class, 'getSection']);

Route::get('/sections/{section}/edit', [SectionController::class, 'edit']);

Route::put('/sections/{section}/update', [SectionController::class, 'update']);

Route::delete('/sections/{section}/delete', [SectionController::class, 'delete']);

Route::post('/sections/{section}/importstudent', [SectionController::class, 'importStudent']);

Route::post('/sections/{section}/student/save', [SectionController::class, 'addStudent']);


//              SECTION STUDENTS

Route::get('/sections/students/all', [SectionStudentsController::class, 'getStudents']);

Route::post('/sections/students/save', [SectionStudentsController::class, 'store']);

Route::delete('/sections/students/remove', [SectionStudentsController::class, 'remove']);


//             SECTION SUBJECTS

Route::post('/sections/{section}', [SectionSubjectsController::class, 'store']);

Route::get('/sections/subjects/all', [SectionSubjectsController::class, 'getSubjects']);

Route::delete('/sections/subjects/remove', [SectionSubjectsController::class, 'remove']);




//                        PARENTS
Route::get('/parents', [GuardianController::class, 'index']);


//                         DEPARTMENTS
Route::get('/departments', [DepartmentController::class, 'index']);

Route::post('/departments/save', [DepartmentController::class, 'store']);

Route::get('/departments/edit/{department}', [DepartmentController::class, 'getDepartment']);

Route::delete('/departments/{department}/delete', [DepartmentController::class, 'delete']);

Route::put('/departments/{department}/update', [DepartmentController::class, 'update']);


//                         SUBJECTS

Route::get('/subjects', [SubjectsController::class, 'index']);

Route::post('/subjects/save', [SubjectsController::class, 'store']);

Route::get('/subjects/edit/{subject}', [SubjectsController::class, 'getSubject']);

Route::put('/subjects/{subject}/update', [SubjectsController::class, 'update']);

Route::delete('/subjects/{subject}/delete', [SubjectsController::class, 'delete']);


//                       SETTINGS

Route::get('/settings', [SettingsController::class, 'index']);



//               SCHOOL YEAR

Route::get('/schoolyears', [SchoolYearController::class, 'getSchoolYears']);

Route::post('/schoolyears/new', [SchoolYearController::class, 'store']);

Route::put('/schoolyears/change', [SchoolYearController::class, 'changeSchoolYear']);



//               LOGS
Route::get('/logs', [LogsController::class, 'index']);

//                 ARCHIVE
Route::get('/archive', [ArchiveController::class, 'index']);





