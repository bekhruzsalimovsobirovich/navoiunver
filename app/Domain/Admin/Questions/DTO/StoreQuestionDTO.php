<?php

namespace App\Domain\Admin\Questions\DTO;

class StoreQuestionDTO
{
    /**
     * @var int
     */
    private int $control_id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $status;

    /**
     * @param array $data
     * @return StoreQuestionDTO
     */
    public static function fromArray(array $data): StoreQuestionDTO
    {
        $dto = new self();
        $dto->setControlId($data['control_id']);
        $dto->setName($data['name']);
        $dto->setStatus($data['status']);

        return $dto;
    }

    /**
     * @return int
     */
    public function getControlId(): int
    {
        return $this->control_id;
    }

    /**
     * @param int $control_id
     */
    public function setControlId(int $control_id): void
    {
        $this->control_id = $control_id;
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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
