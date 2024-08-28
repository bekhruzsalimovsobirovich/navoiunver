<?php

namespace App\Domain\Users\Results\Actions;

use App\Domain\Users\Results\DTO\StoreResultDTO;
use App\Domain\Users\Results\Models\Result;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreResultAction
{
    use \App\Models\Trait\Result;

    /**
     * @param StoreResultDTO $dto
     * @return array
     * @throws Exception
     */
    public function execute(StoreResultDTO $dto)
    {
        DB::beginTransaction();
        try {
            foreach ($dto->getData() as $data) {
                $result = new Result();
                $result->control_id = $dto->getControlId();
                $result->user_id = Auth::id();
                $result->question_id = $data['question_id'];
                $result->answer_id = $data['answer_id'];
                $result->save();
            }
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $this->result(Auth::user()->results);
    }
}
