<?php

namespace App\Http\Controllers\Admin\Controls;

use App\Domain\Admin\Controls\Actions\StoreControlAction;
use App\Domain\Admin\Controls\DTO\StoreControlDTO;
use App\Domain\Admin\Controls\Repositories\ControlRepository;
use App\Domain\Admin\Controls\Requests\StoreControlRequest;
use App\Domain\Admin\Controls\Resources\ControlResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlController extends Controller
{
    /**
     * @var mixed|ControlRepository
     */
    public mixed $controls;

    /**
     * @param ControlRepository $controlRepository
     */
    public function __construct(ControlRepository $controlRepository)
    {
        $this->controls = $controlRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ControlResource::collection($this->controls->paginate());
    }

    /**
     * @return JsonResponse
     */
    public function getAll()
    {
        return $this->successResponse('ok', $this->controls->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreControlRequest $request, StoreControlAction $action)
    {
        try {
            $dto = StoreControlDTO::fromArray($request->validated());
            $response = $action->execute($dto);
            return $this->successResponse('Control created successfully.', $response);
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
