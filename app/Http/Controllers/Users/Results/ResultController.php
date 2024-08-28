<?php

namespace App\Http\Controllers\Users\Results;

use App\Domain\Users\Results\Actions\StoreResultAction;
use App\Domain\Users\Results\DTO\StoreResultDTO;
use App\Domain\Users\Results\Requests\StoreResultRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function store(StoreResultRequest $request, StoreResultAction $action)
    {
        try {
            $dto = StoreResultDTO::fromArray($request->validated());
            $response = $action->execute($dto);
            return $this->successResponse('Question completed successfully.', $response);
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
