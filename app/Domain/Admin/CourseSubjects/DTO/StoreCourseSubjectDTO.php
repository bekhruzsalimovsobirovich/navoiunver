<?php

namespace App\Domain\Admin\CourseSubjects\DTO;

class StoreCourseSubjectDTO
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
     * @param array $data
     * @return StoreCourseSubjectDTO
     */
    public static function fromArray(array $data): StoreCourseSubjectDTO
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setCourseId($data['course_id']);
        $dto->setCoursePlanId($data['course_plan_id']);
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
}
