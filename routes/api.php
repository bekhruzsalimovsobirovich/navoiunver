<?php

use App\Http\Controllers\Admin\CoursePlans\CoursePlanController;
use App\Http\Controllers\Admin\Courses\CourseController;
use App\Http\Controllers\Admin\CourseSubjects\CourseSubjectController;
use App\Http\Controllers\Admin\Lessons\LessonController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Users\Lesson\LessonUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'store']);


Route::group(['prefix' => 'admin','middleware' => ['auth:sanctum','role:superadmin']], function (){
    Route::apiResource('courses',CourseController::class);
    Route::apiResource('course_plans',CoursePlanController::class);
    Route::apiResource('course_subjects',CourseSubjectController::class);
    Route::apiResource('lessons',LessonController::class);
    Route::get('lesson/update/status/{lesson}',[LessonController::class,'updateStatus']);
    Route::get('course_plan/all',[CoursePlanController::class,'getAll']);
    Route::get('find/course_plan/with/{course_id}/course',[CoursePlanController::class,'findCoursePlanWithCourseId']);
    Route::get('find/course_subject/with/{course_id}/course/{course_plan_id}/course_plan',[CourseSubjectController::class,'findCourseSubjectWithCourseIdCoursePlanId']);
    Route::get('course_subject/all',[CourseSubjectController::class,'getAll']);
    Route::get('course/all',[CourseController::class,'getAll']);
});

Route::group(['prefix' => 'student','middleware' => ['auth:sanctum','role:user']], function (){
    Route::get('lesson/{lesson}/read',[LessonUserController::class,'store']);
});
