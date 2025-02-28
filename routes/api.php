<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\API\ClassroomController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\ParentController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\ExamTypeController;
use App\Http\Controllers\API\ExamController;
use App\Http\Controllers\API\ExamResultController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    // Grades routes
    Route::apiResource('grades', GradeController::class);
    
    // Classrooms routes
    Route::apiResource('classrooms', ClassroomController::class);
    
    // Teachers routes
    Route::apiResource('teachers', TeacherController::class);
    
    // Courses routes
    Route::apiResource('courses', CourseController::class);
    
    // Students routes
    Route::apiResource('students', StudentController::class);
    
    // Parents routes
    Route::apiResource('parents', ParentController::class);
    
    // Attendances routes
    Route::apiResource('attendances', AttendanceController::class);
    
    // Exam Types routes
    Route::apiResource('exam-types', ExamTypeController::class);
    
    // Exams routes
    Route::apiResource('exams', ExamController::class);
    
    // Exam Results routes
    Route::apiResource('exam-results', ExamResultController::class);
    
Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::put('students/{id}', [StudentController::class, 'update']);
Route::delete('students/{id}', [StudentController::class, 'destroy']);
    
    // Additional custom routes
    Route::get('classrooms/{classroom}/students', [ClassroomController::class, 'getStudents']);
    Route::get('students/{student}/attendances', [StudentController::class, 'getAttendances']);
    Route::get('students/{student}/exam-results', [StudentController::class, 'getExamResults']);
    Route::get('courses/{course}/exam-results', [CourseController::class, 'getExamResults']);
});