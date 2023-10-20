<?php
use App\Models\AchievementImage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LrController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UpdatesController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ClassRecordController;
use App\Http\Controllers\OrgChartRowController;
use App\Http\Controllers\UpdateImageController;
use App\Http\Controllers\VideoLessonController;
use App\Http\Controllers\OrgChartRowItemController;
use App\Http\Controllers\SectionStudentsController;
use App\Http\Controllers\SectionSubjectsController;
use App\Http\Controllers\AchievementImageController;
use App\Http\Controllers\DownloadableFileController;
use App\Http\Controllers\CalendarOfActivitiesController;
use App\Http\Controllers\StudentAccess\PortalController;
use App\Http\Controllers\DownloadableFilesGroupController;
use App\Http\Controllers\ClassRecordEvaluationCriteriaController;

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

Route::get('/faculty/dashboard', [FacultyController::class, 'dashboard']);

Route::get('/student/dashboard', [StudentController::class, 'index']);


require __DIR__ . '/auth.php';

// HOME
Route::get('/', [WebsiteController::class, 'index'])->name('home');

// SEND FEEDBACK FROM WEBSITE
Route::post('/feedback/save', [FeedbackController::class, 'store'])->name('feedback.store');


Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::put('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

Route::middleware(['auth', 'role:guidance'])->group(function () {

    // FEEDBACK
    Route::controller(FeedbackController::class)->group(function () {
        Route::get('/feedback', 'index')->name('feedback.index');
        Route::get('/feedback/{feedback}', 'show')->name('feedback.show');
        Route::post('/feedback/{feedback}/replyfeedback', 'reply')->name('feedback.reply');
        Route::put('/feedback/{feedback}/read', 'read')->name('feedback.read');
    });

    // UPDATES
    Route::prefix('updates')->group(function () {
        Route::controller(UpdatesController::class)->group(function () {
            Route::get('/', 'index')->name('update.index');
            Route::get('/create', 'create')->name('update.create');
            Route::get('/list', 'list')->name('update.list');
            Route::post('/save', 'store')->name('update.store');
            Route::get('/{update}', 'show')->name('update.show');
            Route::get('/{update}/edit', 'edit')->name('update.edit');
            Route::put('/{update}/update', 'update')->name('update.update');
            Route::delete('/{update}/delete', 'delete')->name('update.delete');

        });

        Route::controller(UpdateImageController::class)->group(function () {
            Route::delete('/{update}/delete-image/{image}', 'destroy')->name('update.deleteImage');
        });
    });

    Route::get('get-update-images', [UpdatesController::class, 'getImages'])->name('update.images');

    // FACULTY
    Route::controller(FacultyController::class)->group(function () {
        Route::get('/faculties', 'index')->name('faculties.index');
        Route::post('/faculties/save', 'store')->name('faculties.store');
        Route::get('/faculties/{faculty}', 'show')->name('faculties.show');
        Route::put('/faculties/{faculty}/update', 'update')->name('faculties.update');
        Route::delete('/faculties/{faculty}/delete', 'delete')->name('faculties.delete');
    });

    // STUDENT
    Route::controller(StudentController::class)->group(function () {
        Route::get('/students', 'index')->name('student.index');
        Route::get('/students/search', 'getStudents')->name('student.getStudents');
        Route::get('/students/{student}', 'show')->name('student.show');
        Route::put('/students/{student}/edit', 'update')->name('student.update');
        Route::delete('/students/{student}/delete', 'delete')->name('student.delete');
        Route::post('/students/register', 'store')->name('student.store');
    });

    // SECTIONS
    Route::controller(SectionController::class)->group(function () {
        Route::get('/sections', 'index')->name('sections.index');
        Route::get('/sections/search', 'searchStudent')->name('sections.searchStudent');
        Route::post('/sections/save', 'store')->name('sections.store');
        Route::post('/sections/import', 'import')->name('sections.import');
        Route::get('/sections/{section}', 'show')->name('sections.show');
        Route::get('/sections/edit/{section}', 'getSection')->name('sections.getSection');
        Route::get('/sections/{section}/edit', 'edit')->name('sections.edit');
        Route::put('/sections/{section}/update', 'update')->name('sections.update');
        Route::delete('/sections/{section}/delete', 'delete')->name('sections.delete');
        Route::post('/sections/{section}/importstudent', 'importStudent')->name('sections.importStudent');
        Route::post('/sections/{section}/student/save', 'addStudent')->name('sections.addStudent');
    });

    // SECTION STUDENTS
    Route::controller(SectionStudentsController::class)->group(function () {
        Route::get('/sections/students/all', 'getStudents')->name('section.students.getStudents');
        Route::post('/sections/students/save', 'store')->name('section.students.store');
        Route::delete('/sections/students/remove', 'remove')->name('section.students.remove');
    });

    // SECTION SUBJECTS
    Route::controller(SectionSubjectsController::class)->group(function () {
        Route::post('/sections/{section}/subjects', 'store')->name('section.subjects.store');
        Route::get('/sections/subjects/all', 'getSubjects')->name('section.subjects.getSubjects');
        Route::delete('/sections/subjects/remove', 'remove')->name('section.subjects.remove');
    });

    // PARENTS
    Route::get('/parents', [GuardianController::class, 'index']);

    // DEPARTMENTS
    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index')->name('departments.index');
        Route::post('/departments/save', 'store')->name('departments.store');
        Route::get('/departments/edit/{department}', 'getDepartment')->name('departments.getDepartment');
        Route::delete('/departments/{department}/delete', 'delete')->name('departments.delete');
        Route::put('/departments/{department}/update', 'update')->name('departments.update');
    });

    // SUBJECTS
    Route::controller(SubjectsController::class)->group(function () {
        Route::get('/subjects', 'index')->name('subjects.index');
        Route::post('/subjects/save', 'store')->name('subjects.store');
        Route::get('/subjects/edit/{subject}', 'getSubject')->name('subjects.getSubject');
        Route::put('/subjects/{subject}/update', 'update')->name('subjects.update');
        Route::delete('/subjects/{subject}/delete', 'delete')->name('subjects.delete');
    });

    // SETTINGS
    Route::get('/settings', [SettingsController::class, 'index']);

    // SCHOOL YEAR
    Route::controller(SchoolYearController::class)->group(function () {
        Route::get('/schoolyears', 'getSchoolYears')->name('schoolyear');
        Route::post('/schoolyears/new', 'store')->name('schoolyear.store');
        Route::put('/schoolyears/change', 'changeSchoolYear')->name('schoolyear.change');
    });

    // LOGS
    Route::get('/logs', [LogsController::class, 'index']);

    // ARCHIVE
    Route::controller(ArchiveController::class)->group(function () {
        Route::get('/archive', 'index')->name('archive.index');
        Route::get('/archive/student/{id}', 'showArchivedStudent')->name('archive.student.show');
        Route::get('/archive/faculty/{id}', 'showArchivedFaculty')->name('archive.faculty.show');
    });

    Route::controller(AchievementController::class)->group(function () {
        Route::get('/achievements/create', 'create')->name('achievements.create');
        Route::post('/achievements/save', 'store')->name('achievements.store');
        Route::get('/achievements', 'index')->name('achievements.index');
        Route::get('/achievements/{achievement}', 'show')->name('achievements.show');
        Route::get('/achievements/{achievement}/edit', 'edit')->name('achievements.edit');
        Route::get('/achievments/list', 'list')->name('achievements.list');
        Route::get('/get-images', 'getImages')->name('achievements.images');
        Route::put('/achievements/{achievement}/update', 'update')->name('achievements.update');
        Route::delete('/achievements/{achievement}/delete', 'delete')->name('achievements.delete');
    });

    Route::delete('/achievements/{achievement}/delete-image/{achievementImage}', [AchievementImageController::class, 'destroy'])
        ->name('achievementImage.delete');

    Route::get('/viewer/{fileId}', [DownloadableFileController::class, 'viewPDF'])->name('downloadables.view');

    Route::controller(DownloadableFileController::class)->group(function () {
        Route::get('/downloadables', 'index')->name('downloadables.index');
        Route::get('/downloadables/list', 'list')->name('downloadables.list');
        Route::post('/downloadables/save', 'store')->name('downloadables.store');
        Route::get('/downloadables/{downloadableFile}', 'show')->name('downloadables.show');
        Route::get('/downloadables/{downloadableFile}/edit', 'edit')->name('downloadables.edit');
        Route::put('/downloadables/{downloadableFile}/update', 'update')->name('downloadables.update');
        Route::delete('/downloadables/{downloadableFile}/delete', 'destroy')->name('downloadables.delete');
    });

    Route::controller(DownloadableFilesGroupController::class)->group(function () {
        Route::delete('/downloadables/group/{downloadablesGroup}/delete', 'destroy')->name('downloadables.group.delete');
    });

    Route::prefix('calendar')->group(function () {
        Route::controller(CalendarOfActivitiesController::class)->group(function () {
            Route::get('', 'index')->name('calendar.index');
            Route::post('/save', 'store')->name('calendar.store');
            Route::get('/viewer/{calendarOfActivities}', 'view')->name('calendar.view');
            Route::get('/{calendarOfActivities}/edit', 'edit')->name('calendar.edit');
            Route::put('/{calendarOfActivities}/update', 'update')->name('calendar.update');
            Route::delete('/{calendarOfActivities}/delete', 'destroy')->name('calendar.delete');
        });
    });

    Route::prefix('org')->group(function () {
        Route::controller(OrgChartRowController::class)->group(function () {
            Route::get('/chart', 'index')->name('org.chart.index');
            Route::get('/chart/create', 'create')->name('org.chart.create');
            Route::prefix('row')->group(function () {
                Route::post('/save', 'store')->name('org.chart.store');
                Route::put('/update', 'update')->name('org.chart.update');
                Route::delete('/{orgChartRow}/delete', 'destroy')->name('org.chart.delete');
            });
        });
        Route::prefix('row')->group(function () {
            Route::controller(OrgChartRowItemController::class)->group(function () {
                Route::post('/item/save', 'store')->name('org.chart.item.store');
                Route::put('/item/update', 'update')->name('org.chart.item.update');
                Route::delete('/item/{orgChartRowItem}/delete', 'destroy')->name('org.chart.item.delete');
            });
        });
    });


});



Route::middleware(['auth', 'role:faculty'])->group(function () {

    // CLASS RECORD
    Route::get('/classes', [ClassesController::class, 'index'])->name('faculty.classes');

    Route::get('/classes/{class}/class-record', [ClassRecordController::class, 'index'])->name('class.record');

    Route::put('/update-percentage/{classRecordEvaluationCriteria}/record/{classRecordId}', [ClassRecordEvaluationCriteriaController::class, 'changePercentage'])
        ->name('class.percentage.update');

    Route::get('/get-percentage/{classRecordEvaluationCriteria}', [ClassRecordEvaluationCriteriaController::class, 'getPercentage'])
        ->name('class.percentage.get');


    // ACTIVITIES
    Route::post('/create-activity', [ActivityController::class, 'store'])->name('activity.store');

    //SCORES
    Route::post('/submit-scores', [ScoreController::class, 'store'])->name('score.store');

});


Route::middleware(['auth', 'role:student'])->group(function () {

    Route::controller(PortalController::class)->group(function () {
        Route::get('/portal/classes', 'portal')->name('student.portal');
        Route::get('/account/settings', 'account')->name('student.profile');
    });

});

Route::middleware(['auth', 'role:lr'])->group(function () {

    Route::prefix('lr')->group(function () {
        Route::controller(LrController::class)->group(function () {
            Route::get('/video-lesson', 'videoLesson')->name('lr.video');
            Route::get('/modules', 'module')->name('lr.module');
        });
    });

    Route::controller(VideoLessonController::class)->group(function () {
        Route::get('/video-lessons', 'index')->name('video-lessons.index');
        Route::post('/video-lessons/save', 'store')->name('video-lessons.store');
        Route::get('/video-lessons/{videoLesson}', 'show')->name('video-lessons.show');
        Route::get('/video-lessons/{videoLesson}/edit', 'edit')->name('video-lessons.edit');
        Route::put('/video-lessons/{videoLesson}/update', 'update')->name('video-lessons.update');
        Route::delete('/video-lessons/{videoLesson}/delete', 'delete')->name('video-lessons.delete');
    });

});
