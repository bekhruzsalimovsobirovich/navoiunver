<?php

namespace App\Domain\Admin\CourseSubjects\Actions;

use App\Domain\Admin\CoursePlans\DTO\StoreCoursePlanDTO;
use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\Courses\DTO\StoreCourseDTO;
use App\Domain\Admin\Courses\Models\Course;
use App\Domain\Admin\CourseSubjects\DTO\StoreCourseSubjectDTO;
use App\Domain\Admin\CourseSubjects\Models\CourseSubject;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreCourseSubjectAction
{
    /**
     * @param StoreCourseSubjectDTO $dto
     * @return CourseSubject
     * @throws Exception
     */
    public function execute(StoreCourseSubjectDTO $dto): CourseSubject
    {
        DB::beginTransaction();
        try {
            $course_subject = new CourseSubject();
            $course_subject->course_id = $dto->getCourseId();
            $course_subject->course_plan_id = $dto->getCoursePlanId();
            $course_subject->name = $dto->getName();
            $course_subject->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $course_subject;
    }
}
