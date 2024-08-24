<?php

namespace App\Domain\Admin\Questions\Actions;

use App\Domain\Admin\Questions\DTO\StoreQuestionDTO;
use App\Domain\Admin\Questions\Models\Question;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreQuestionAction
{
    /**
     * @param StoreQuestionDTO $dto
     * @return Question
     * @throws Exception
     */
    public function execute(StoreQuestionDTO $dto): Question
    {
        DB::beginTransaction();
        try {
            $question = new Question();
            $question->control_id = $dto->getControlId();
            $question->name = $dto->getName();
            $question->status = $dto->getStatus();
            $question->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $question;
    }
}
