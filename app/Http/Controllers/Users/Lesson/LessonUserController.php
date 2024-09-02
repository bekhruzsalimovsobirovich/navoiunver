<?php

namespace App\Http\Controllers\Users\Lesson;

use App\Domain\Admin\Lessons\Models\Lesson;
use App\Http\Controllers\Controller;
use App\Models\LessonUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonUserController extends Controller
{
    public function index()
    {
        $lessons = Lesson::query()
            ->with(['lesson_users' => function ($query) {
                $query->where('user_id', Auth::id());
            }, 'course_plan'])  // Eager load course_plan to group later
            ->get()
            ->groupBy('course_plan.name');

        $data = [];

        foreach ($lessons as $coursePlanName => $lessonsGroup) {
            $total = count($lessonsGroup);
            $count_read = $lessonsGroup->filter(function ($lesson) {
                return isset($lesson->lesson_users->status) && $lesson->lesson_users->status == 1;
            })->count();

            $data[$coursePlanName] = [
                'total' => $total,
                'read' => $count_read,
                'unread' => $total - $count_read,
                'percent' => round(($count_read * 100) / $total, 1)
            ];
        }

        return $this->successResponse('User Subject calculate', $data);
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

    /**
     * @param Request $request
     * @param Lesson $lesson
     * @return JsonResponse
     */
    public function storeComment(Request $request, Lesson $lesson)
    {
        $request->validate([
            'text' => 'required'
        ]);

        $lesson->comments()->create([
            'user_id' => Auth::id(),
            'text' => $request['text'],
        ]);

        return $this->successResponse('Comment sended.');
    }
}
