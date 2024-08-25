<?php

namespace App\Domain\Admin\QuestionsAnswers\DTO;

class StoreQuestionAnswerDTO
{
    /**
     * @var int
     */
    private int $control_id;

    /**
     * @var array
     */
    private array $low;

    /**
     * @var array
     */
    private array $middle;

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
        $dto->setLow($data['low']);
        $dto->setMiddle($data['middle']);
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
     * @return array
     */
    public function getLow(): array
    {
        return $this->low;
    }

    /**
     * @param array $low
     */
    public function setLow(array $low): void
    {
        $this->low = $low;
    }

    /**
     * @return array
     */
    public function getMiddle(): array
    {
        return $this->middle;
    }

    /**
     * @param array $middle
     */
    public function setMiddle(array $middle): void
    {
        $this->middle = $middle;
    }

//    /**
//     * @return array
//     */
//    public function getHigh(): array
//    {
//        return $this->high;
//    }
//
//    /**
//     * @param array $high
//     */
//    public function setHigh(array $high): void
//    {
//        $this->high = $high;
//    }
}
