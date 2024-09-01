<?php

use App\Http\Controllers\Admin\Controls\ControlController;
use App\Http\Controllers\Admin\CoursePlans\CoursePlanController;
use App\Http\Controllers\Admin\Courses\CourseController;
use App\Http\Controllers\Admin\CourseSubjects\CourseSubjectController;
use App\Http\Controllers\Admin\Lessons\LessonController;
use App\Http\Controllers\Admin\QuestionsAnswers\QuestionAnswerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Users\Lesson\LessonUserController;
use App\Http\Controllers\Users\Results\ResultController;
use App\Http\Controllers\Users\UserController;
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

Route::get('controls',[ControlController::class,'index']);
Route::get('questions/with/answers/{control_id}/control',[QuestionAnswerController::class,'index']);

Route::group(['prefix' => 'admin','middleware' => ['auth:sanctum','role:superadmin']], function (){
    Route::apiResource('courses',CourseController::class);
    Route::apiResource('course_plans',CoursePlanController::class);
    Route::apiResource('course_subjects',CourseSubjectController::class);
    Route::apiResource('lessons',LessonController::class);
    Route::apiResource('controls',ControlController::class);
    Route::get('lesson/update/status/{lesson}',[LessonController::class,'updateStatus']);
    Route::get('course_plan/all',[CoursePlanController::class,'getAll']);
    Route::get('find/course_plan/with/{course_id}/course',[CoursePlanController::class,'findCoursePlanWithCourseId']);
    Route::get('find/course_subject/with/{course_id}/course/{course_plan_id}/course_plan',[CourseSubjectController::class,'findCourseSubjectWithCourseIdCoursePlanId']);
    Route::get('course_subject/all',[CourseSubjectController::class,'getAll']);
    Route::get('users',[UserController::class,'index']);

    Route::post('/updateOrCreate/file/lesson/{lesson_id}',[LessonController::class,'createFileAndUpdate']);

    Route::post('questions/with/answers',[QuestionAnswerController::class,'store']);
    Route::post('questions/with/answers/update',[QuestionAnswerController::class,'update']);
    Route::delete('questions/with/answers/delete/{question}',[QuestionAnswerController::class,'destroy']);
});

Route::group(['middleware' => ['auth:sanctum','role:user|superadmin']], function (){
    Route::get('control/all',[ControlController::class,'getAll']);
    Route::get('course/all',[CourseController::class,'getAll']);
});

Route::group(['prefix' => 'student','middleware' => ['auth:sanctum','role:user']], function (){
    Route::get('lesson/{lesson}/read',[LessonUserController::class,'store']);
    Route::get('course/{course_id}/lesson',[LessonController::class,'getLessonCourse']);
    Route::post('/result/store',[ResultController::class,'store']);

    Route::get('/lesson/calc',[LessonUserController::class,'index']);
});
