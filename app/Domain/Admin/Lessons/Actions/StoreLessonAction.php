<?php

namespace App\Domain\Admin\Lessons\Actions;

use App\Domain\Admin\Lessons\DTO\StoreLessonDTO;
use App\Domain\Admin\Lessons\Models\Lesson;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreLessonAction
{
    /**
     * @param StoreLessonDTO $dto
     * @return Lesson
     * @throws Exception
     */
    public function execute(StoreLessonDTO $dto): Lesson
    {
        DB::beginTransaction();
        try {
            $lesson = new Lesson();
            $lesson->course_id = $dto->getCourseId();
            $lesson->course_plan_id = $dto->getCoursePlanId();
            $lesson->course_subject_id = $dto->getCourseSubjectId();
            $lesson->date = $dto->getDate();
            $lesson->save();

//            $types = ['lesson', 'video', 'electron', 'crossword'];
//
//            foreach ($types as $key => $type) {
//                if (request()->hasFile("files.$key")) {
//                    $file = request()->file("files.$key");
//
//                    $filename = Str::random(6) . '_' . time() . '.' . $file->getClientOriginalExtension();
//                    $file->storeAs('public/files/lessons', $filename);
//                    $path = url('storage/files/lessons/' . $filename);
//
//                    $lesson->files()->create([
//                        'filename' => $filename,
//                        'path' => $path,
//                        'type' => $type,
//                    ]);
//                }
//            }
            $lesson->load('course','course_plan','course_subject');
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $lesson;
    }
}
