<?php

namespace App\Http\Controllers\Admin\CoursePlans;

use App\Domain\Admin\CoursePlans\Actions\StoreCoursePlanAction;
use App\Domain\Admin\CoursePlans\Actions\UpdateCoursePlanAction;
use App\Domain\Admin\CoursePlans\DTO\StoreCoursePlanDTO;
use App\Domain\Admin\CoursePlans\DTO\UpdateCoursePlanDTO;
use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\CoursePlans\Repositories\CoursePlanRepository;
use App\Domain\Admin\CoursePlans\Requests\StoreCoursePlanRequest;
use App\Domain\Admin\CoursePlans\Requests\UpdateCoursePlanRequest;
use App\Http\Controllers\Controller;
use Exception;

class CoursePlanController extends Controller
{
    /**
     * @var mixed|CoursePlanRepository
     */
    public mixed $course_plans;

    /**
     * @param CoursePlanRepository $coursePlanRepository
     */
    public function __construct(CoursePlanRepository $coursePlanRepository)
    {
        $this->course_plans = $coursePlanRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse('ok', $this->course_plans->paginate());
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        return $this->successResponse('ok', $this->course_plans->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoursePlanRequest $request, StoreCoursePlanAction $action)
    {
        try {
            $dto = StoreCoursePlanDTO::fromArray($request->validated());
            $response = $action->execute($dto);
            return $this->successResponse('Course plan created successfully.', $response);
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
    public function update(UpdateCoursePlanRequest $request, CoursePlan $course_plan, UpdateCoursePlanAction $action)
    {
        try {
            $request->validated();
            $request->merge([
                'course_plan' => $course_plan
            ]);
            $dto = UpdateCoursePlanDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return $this->successResponse('Course plan updated successfully.', $response);
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoursePlan $course_plan)
    {
        $course_plan->delete();
        return $this->successResponse('Course plan deleted successfully');
    }
}
