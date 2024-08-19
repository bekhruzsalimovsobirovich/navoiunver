<?php

namespace App\Domain\Admin\CourseSubjects\DTO;

use App\Domain\Admin\CourseSubjects\Models\CourseSubject;

class UpdateCourseSubjectDTO
{
    /**
     * @var int
     */
    private int $course_id;

    /**
     * @var int
     */
    private int $course_plan_id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var CourseSubject
     */
    public CourseSubject $course_subject;

    /**
     * @param array $data
     * @return UpdateCourseSubjectDTO
     */
    public static function fromArray(array $data): UpdateCourseSubjectDTO
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setCourseId($data['course_id']);
        $dto->setCoursePlanId($data['course_plan_id']);
        $dto->setCourseSubject($data['course_subject']);
        return $dto;
    }

    /**
     * @return int
     */
    public function getCourseId(): int
    {
        return $this->course_id;
    }

    /**
     * @param int $course_id
     */
    public function setCourseId(int $course_id): void
    {
        $this->course_id = $course_id;
    }

    /**
     * @return int
     */
    public function getCoursePlanId(): int
    {
        return $this->course_plan_id;
    }

    /**
     * @param int $course_plan_id
     */
    public function setCoursePlanId(int $course_plan_id): void
    {
        $this->course_plan_id = $course_plan_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return CourseSubject
     */
    public function getCourseSubject(): CourseSubject
    {
        return $this->course_subject;
    }

    /**
     * @param CourseSubject $course_subject
     */
    public function setCourseSubject(CourseSubject $course_subject): void
    {
        $this->course_subject = $course_subject;
    }
}
