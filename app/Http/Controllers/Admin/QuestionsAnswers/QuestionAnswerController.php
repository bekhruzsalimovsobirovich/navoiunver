<?php

namespace App\Http\Controllers\Admin\QuestionsAnswers;

use App\Domain\Admin\QuestionsAnswers\Actions\StoreQuestionAnswerAction;
use App\Domain\Admin\QuestionsAnswers\DTO\StoreQuestionAnswerDTO;
use App\Domain\Admin\QuestionsAnswers\Repositories\QuestionAnswerRepository;
use App\Domain\Admin\QuestionsAnswers\Requests\StoreQuestionAnswerRequest;
use App\Http\Controllers\Controller;
use Exception;

class QuestionAnswerController extends Controller
{
    /**
     * @var mixed|QuestionAnswerRepository
     */
    public mixed $questionsAnswers;

    /**
     * @param QuestionAnswerRepository $questionAnswerRepository
     */
    public function __construct(QuestionAnswerRepository $questionAnswerRepository)
    {
        $this->questionsAnswers = $questionAnswerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($control_id)
    {
        return $this->successResponse('',$this->questionsAnswers->getAll($control_id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionAnswerRequest $request, StoreQuestionAnswerAction $action)
    {
        try {
            $dto = StoreQuestionAnswerDTO::fromArray($request->validated());
            $response = $action->execute($dto);
            return $this->successResponse('Question created successfully.', $response);
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
