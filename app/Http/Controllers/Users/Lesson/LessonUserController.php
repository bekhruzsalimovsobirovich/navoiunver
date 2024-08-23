<?php

namespace App\Http\Controllers\Users\Lesson;

use App\Domain\Admin\Lessons\Models\Lesson;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LessonUserController extends Controller
{
    public function index()
    {
//        $lessons =
    }

    /**
     * @param Lesson $lesson
     * @return JsonResponse
     */
    public function store(Lesson $lesson)
    {
        if (Auth::user()->hasRole('user')) {
            $lesson->lesson_user()->sync([
                Auth::id() => ['status' => true],
            ]);
        }

        return $this->successResponse('User read this ' . $lesson->course_subject->name . ' course');
    }
}
