<?php

namespace App\Domain\Admin\CoursePlans\DTO;

use App\Domain\Admin\CoursePlans\Models\CoursePlan;

class UpdateCoursePlanDTO
{
    /**
     * @var int
     */
    private int $course_id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var CoursePlan
     */
    private CoursePlan $course_plan;

    /**
     * @param array $data
     * @return UpdateCoursePlanDTO
     */
    public static function fromArray(array $data): UpdateCoursePlanDTO
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setCourseId($data['course_id']);
        $dto->setCoursePlan($data['course_plan']);
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
     * @return CoursePlan
     */
    public function getCoursePlan(): CoursePlan
    {
        return $this->course_plan;
    }

    /**
     * @param CoursePlan $course_plan
     */
    public function setCoursePlan(CoursePlan $course_plan): void
    {
        $this->course_plan = $course_plan;
    }
}
