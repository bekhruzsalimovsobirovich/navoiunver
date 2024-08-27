<?php

namespace App\Domain\Admin\Lessons\Actions;

use App\Domain\Admin\Lessons\DTO\StoreLessonDTO;
use App\Domain\Admin\Lessons\DTO\UpdateLessonDTO;
use App\Domain\Admin\Lessons\Models\Lesson;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UpdateLessonAction
{
    /**
     * @param UpdateLessonDTO $dto
     * @return Lesson
     * @throws Exception
     */
    public function execute(UpdateLessonDTO $dto): Lesson
    {
        DB::beginTransaction();
        try {
            $lesson = $dto->getLesson();
            $lesson->course_id = $dto->getCourseId();
            $lesson->course_plan_id = $dto->getCoursePlanId();
            $lesson->course_subject_id = $dto->getCourseSubjectId();
            $lesson->date = $dto->getDate();
            $lesson->update();

            if (isset(request()->files)) {
                foreach (request()->files as $file) {
                    foreach ($file as $key => $fl) {

                        if (request()->hasFile("files.$key")) {
                            $file = request()->file("files.$key");
                            $currentFile = \App\Domain\Admin\Files\Models\File::query()->find(request()->file_id[$key]);
                            if ($currentFile != null) {

                                File::delete('storage/files/lessons/' . $currentFile->filename);
                                $filename = Str::random(6) . '_' . time() . '.' . $file->getClientOriginalExtension();
                                $file->storeAs('public/files/lessons', $filename);
                                $path = url('storage/files/lessons/' . $filename);
                                $currentFile->filename = $filename;
                                $currentFile->path = $path;
                                $currentFile->update();
                            } else {
                                $filename = Str::random(6) . '_' . time() . '.' . $file->getClientOriginalExtension();
                                $file->storeAs('public/files/lessons', $filename);
                                $path = url('storage/files/lessons/' . $filename);

                                $lesson->files()->create([
                                    'filename' => $filename,
                                    'path' => $path,
                                    'type' => 'lesson',
                                ]);
                            }

                        }
                    }
                }
            }

            $lesson->load('course', 'course_plan', 'course_subject');

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        DB::commit();
        return $lesson;
    }
}
