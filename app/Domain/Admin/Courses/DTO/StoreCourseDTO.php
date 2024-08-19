<?php

namespace App\Domain\Admin\Courses\DTO;

class StoreCourseDTO
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @param array $data
     * @return StoreCourseDTO
     */
    public static function fromArray(array $data): StoreCourseDTO
    {
        $dto = new self();
        $dto->setName($data['name']);
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
}
