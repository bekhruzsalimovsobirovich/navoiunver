<?php

namespace App\Domain\Admin\CoursePlans\Actions;

use App\Domain\Admin\CoursePlans\DTO\StoreCoursePlanDTO;
use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\Courses\DTO\StoreCourseDTO;
use App\Domain\Admin\Courses\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreCoursePlanAction
{
    /**
     * @param StoreCoursePlanDTO $dto
     * @return CoursePlan
     * @throws Exception
     */
    public function execute(StoreCoursePlanDTO $dto): CoursePlan
    {
        DB::beginTransaction();
        try {
            $course_plan = new CoursePlan();
            $course_plan->course_id = $dto->getCourseId();
            $course_plan->name = $dto->getName();
            $course_plan->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $course_plan;
    }
}
