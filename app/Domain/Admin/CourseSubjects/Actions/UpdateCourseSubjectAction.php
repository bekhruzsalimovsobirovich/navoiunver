<?php

namespace App\Domain\Admin\CourseSubjects\Actions;

use App\Domain\Admin\CoursePlans\DTO\StoreCoursePlanDTO;
use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\Courses\DTO\StoreCourseDTO;
use App\Domain\Admin\Courses\Models\Course;
use App\Domain\Admin\CourseSubjects\DTO\StoreCourseSubjectDTO;
use App\Domain\Admin\CourseSubjects\DTO\UpdateCourseSubjectDTO;
use App\Domain\Admin\CourseSubjects\Models\CourseSubject;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateCourseSubjectAction
{
    /**
     * @param UpdateCourseSubjectDTO $dto
     * @return CourseSubject
     * @throws Exception
     */
    public function execute(UpdateCourseSubjectDTO $dto): CourseSubject
    {
        DB::beginTransaction();
        try {
            $course_subject = $dto->getCourseSubject();
            $course_subject->course_id = $dto->getCourseId();
            $course_subject->course_plan_id = $dto->getCoursePlanId();
            $course_subject->name = $dto->getName();
            $course_subject->update();
            $course_subject->load('course','course_plan');
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $course_subject;
    }
}
