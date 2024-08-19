<?php

namespace App\Domain\Admin\Courses\Actions;

use App\Domain\Admin\Courses\DTO\StoreCourseDTO;
use App\Domain\Admin\Courses\DTO\UpdateCourseDTO;
use App\Domain\Admin\Courses\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateCourseAction
{
    /**
     * @param UpdateCourseDTO $dto
     * @return Course
     * @throws Exception
     */
    public function execute(UpdateCourseDTO $dto): Course
    {
        DB::beginTransaction();
        try {
            $course = $dto->getCourse();
            $course->name = $dto->getName();
            $course->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $course;
    }
}
