<?php

namespace App\Http\Controllers\Admin\Questions;

use App\Domain\Admin\Questions\Actions\StoreQuestionAction;
use App\Domain\Admin\Questions\DTO\StoreQuestionDTO;
use App\Domain\Admin\Questions\Repositories\QuestionRepository;
use App\Domain\Admin\Questions\Requests\StoreQuestionRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * @var mixed|QuestionRepository
     */
    public mixed $questions;

    /**
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questions = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse('ok', $this->questions->paginate());
    }

    /**
     * @return JsonResponse
     */
    public function getAll()
    {
        return $this->successResponse('ok', $this->questions->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request, StoreQuestionAction $action)
    {
        try {
            $dto = StoreQuestionDTO::fromArray($request->validated());
            $response = $action->execute($dto);
            return $this->successResponse('Question created successfully.', $response);
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
