<?php

namespace App\Domain\Admin\CoursePlans\Actions;

use App\Domain\Admin\CoursePlans\DTO\StoreCoursePlanDTO;
use App\Domain\Admin\CoursePlans\DTO\UpdateCoursePlanDTO;
use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\Courses\DTO\StoreCourseDTO;
use App\Domain\Admin\Courses\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateCoursePlanAction
{
    /**
     * @param UpdateCoursePlanDTO $dto
     * @return CoursePlan
     * @throws Exception
     */
    public function execute(UpdateCoursePlanDTO $dto): CoursePlan
    {
        DB::beginTransaction();
        try {
            $course_plan = $dto->getCoursePlan();
            $course_plan->course_id = $dto->getCourseId();
            $course_plan->name = $dto->getName();
            $course_plan->update();
            $course_plan->load('course');
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $course_plan;
    }
}
