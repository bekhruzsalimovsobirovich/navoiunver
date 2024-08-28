<?php

namespace App\Domain\Users\Results\DTO;

class StoreResultDTO
{
    /**
     * @var int
     */
    private int $control_id;

    /**
     * @var array
     */
    private array $data;

    /**
     * @param array $data
     * @return StoreResultDTO
     */
    public static function fromArray(array $data): StoreResultDTO
    {
        $dto = new self();
        $dto->setControlId($data['control_id']);
        $dto->setData($data['data']);

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
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }
}
