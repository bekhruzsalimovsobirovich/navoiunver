<?php

namespace App\Domain\Admin\Lessons\DTO;

class StoreLessonDTO
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
     * @var int
     */
    private int $course_subject_id;

    /**
     * @var string
     */
    private string $date;

    /**
     * @param array $data
     * @return StoreLessonDTO
     */
    public static function fromArray(array $data): StoreLessonDTO
    {
        $dto = new self();
        $dto->setCourseId($data['course_id']);
        $dto->setCoursePlanId($data['course_plan_id']);
        $dto->setCourseSubjectId($data['course_subject_id']);
        $dto->setDate($data['date']);
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
     * @return int
     */
    public function getCourseSubjectId(): int
    {
        return $this->course_subject_id;
    }

    /**
     * @param int $course_subject_id
     */
    public function setCourseSubjectId(int $course_subject_id): void
    {
        $this->course_subject_id = $course_subject_id;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }
}
