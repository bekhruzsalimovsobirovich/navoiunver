<?php

namespace App\Domain\Admin\QuestionsAnswers\Actions;

use App\Domain\Admin\QuestionsAnswers\DTO\StoreQuestionAnswerDTO;
use App\Domain\Admin\QuestionsAnswers\Models\Answer;
use App\Domain\Admin\QuestionsAnswers\Models\Question;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreQuestionAnswerAction
{
    /**
     * @param StoreQuestionAnswerDTO $dto
     * @return array
     * @throws Exception
     */
    public function execute(StoreQuestionAnswerDTO $dto): array
    {
        DB::beginTransaction();
        try {
            $savedQuestions = [];

            // Helper function to save questions and answers
            $saveQuestion = function ($questions, $status) use (&$savedQuestions, $dto) {
                foreach ($questions as $questionData) {
                    $question = new Question();
                    $question->control_id = $dto->getControlId();
                    $question->name = $questionData['question'];
                    $question->status = $status;
                    $question->active = $questionData['active'];
                    $question->save();

                    foreach ($questionData['answers'] as $index => $answerText) {
                        $answer = new Answer();
                        $answer->question_id = $question->id;
                        $answer->text = $answerText;
                        $answer->correct = $index === 0;
                        $answer->save();
                    }

                    $savedQuestions[] = $question->load('answers');
                }
            };

            // Save low and middle questions
            if($dto->getLow()){
                $saveQuestion($dto->getLow(), 'low');
            }
            if($dto->getMiddle()){
                $saveQuestion($dto->getMiddle(), 'middle');
            }

            DB::commit();
            return $savedQuestions;

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param StoreQuestionAnswerDTO $dto
     * @return array
     * @throws Exception
     */
    public function update(StoreQuestionAnswerDTO $dto): array
    {
        DB::beginTransaction();
        try {
            $updatedQuestions = [];

            // Helper function to update or create questions and answers
            $saveOrUpdateQuestion = function ($questions, $status) use (&$updatedQuestions, $dto) {
                foreach ($questions as $questionData) {
                    $question = Question::find($questionData['id']) ?? new Question();
                    $question->control_id = $dto->getControlId();
                    $question->name = $questionData['question'];
                    $question->status = $status;
                    $question->active = $questionData['active'];
                    $question->save();

                    // Keep track of answer IDs for deletion later
                    $existingAnswerIds = $question->answers()->pluck('id')->toArray();
                    $newAnswerIds = [];

                    foreach ($questionData['answers'] as $index => $answerText) {
                        $answer = $question->answers()->where('id', $questionData['answer_ids'][$index] ?? null)->first() ?? new Answer();
                        $answer->question_id = $question->id;
                        $answer->text = $answerText;
                        $answer->correct = $index === 0;
                        $answer->save();
                        $newAnswerIds[] = $answer->id;
                    }

                    // Delete answers that are no longer associated with the question
                    $answersToDelete = array_diff($existingAnswerIds, $newAnswerIds);
                    Answer::whereIn('id', $answersToDelete)->delete();

                    $updatedQuestions[] = $question->load('answers');
                }
            };

            // Update low and middle questions
            if ($dto->getLow()) {
                $saveOrUpdateQuestion($dto->getLow(), 'low');
            }
            if ($dto->getMiddle()) {
                $saveOrUpdateQuestion($dto->getMiddle(), 'middle');
            }

            DB::commit();
            return $updatedQuestions;

        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
