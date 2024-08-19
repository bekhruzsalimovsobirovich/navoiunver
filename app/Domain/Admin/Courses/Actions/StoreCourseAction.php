<?php

namespace App\Domain\Admin\Courses\Actions;

use App\Domain\Admin\Courses\DTO\StoreCourseDTO;
use App\Domain\Admin\Courses\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreCourseAction
{
    /**
     * @param StoreCourseDTO $dto
     * @return Course
     * @throws Exception
     */
    public function execute(StoreCourseDTO $dto): Course
    {
        DB::beginTransaction();
        try {
            $course = new Course();
            $course->name = $dto->getName();
            $course->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $course;
    }
}
