<?php

namespace App\Domain\Admin\QuestionsAnswers\DTO;

class StoreQuestionAnswerDTO
{
    /**
     * @var int
     */
    private int $control_id;

    /**
     * @var array|null
     */
    private ?array $low=null;

    /**
     * @var array|null
     */
    private ?array $middle=null;

//    /**
//     * @var array
//     */
//    private array $high;

    /**
     * @param array $data
     * @return StoreQuestionAnswerDTO
     */
    public static function fromArray(array $data): StoreQuestionAnswerDTO
    {
        $dto = new self();
        $dto->setControlId($data['control_id']);
        $dto->setLow($data['low'] ?? null);
        $dto->setMiddle($data['middle'] ?? null);
//        $dto->setHigh($data['high']);

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
     * @return array|null
     */
    public function getLow(): ?array
    {
        return $this->low;
    }

    /**
     * @param array|null $low
     */
    public function setLow(?array $low): void
    {
        $this->low = $low;
    }

    /**
     * @return array|null
     */
    public function getMiddle(): ?array
    {
        return $this->middle;
    }

    /**
     * @param array|null $middle
     */
    public function setMiddle(?array $middle): void
    {
        $this->middle = $middle;
    }
}
