<?php

namespace App\Domain\Admin\Courses\DTO;

use App\Domain\Admin\Courses\Models\Course;

class UpdateCourseDTO
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var Course
     */
    private Course $course;

    /**
     * @param array $data
     * @return UpdateCourseDTO
     */
    public static function fromArray(array $data): UpdateCourseDTO
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setCourse($data['course']);
        return $dto;
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
     * @return Course
     */
    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @param Course $course
     */
    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }
}
