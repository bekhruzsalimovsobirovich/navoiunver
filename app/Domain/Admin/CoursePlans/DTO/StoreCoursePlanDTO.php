<?php

namespace App\Domain\Admin\CoursePlans\DTO;

class StoreCoursePlanDTO
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
     * @param array $data
     * @return StoreCoursePlanDTO
     */
    public static function fromArray(array $data): StoreCoursePlanDTO
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setCourseId($data['course_id']);
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
}
