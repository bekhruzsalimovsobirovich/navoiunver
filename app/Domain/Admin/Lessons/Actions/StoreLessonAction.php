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

            // Store each file
            foreach (request()->file('files') as $key => $file) {

                if ($key == 0) {
                    $type = 'lesson';
                } elseif ($key == 1) {
                    $type = 'video';
                } elseif ($key == 2) {
                    $type = 'electron';
                } elseif ($key == 3) {
                    $type = 'crossword';
                }

                $file_req = $file;
                $filename = Str::random(4) . '_' . time() . '.' . $file_req->getClientOriginalExtension();
                $file_req->storeAs('public/files/lessons', $filename);
                $path = url('storage/files/lessons/' . $filename);
                $lesson->files()->create([
                    'filename' => $filename,
                    'path' => $path,
                    'type' => $type
                ]);
            }
            $lesson->load('course','course_plan','course_subject');
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $lesson;
    }
}
