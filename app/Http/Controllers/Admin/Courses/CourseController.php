<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Domain\Admin\Courses\Actions\StoreCourseAction;
use App\Domain\Admin\Courses\Actions\UpdateCourseAction;
use App\Domain\Admin\Courses\DTO\StoreCourseDTO;
use App\Domain\Admin\Courses\DTO\UpdateCourseDTO;
use App\Domain\Admin\Courses\Models\Course;
use App\Domain\Admin\Courses\Repositories\CourseRepository;
use App\Domain\Admin\Courses\Requests\StoreCourseRequest;
use App\Domain\Admin\Courses\Requests\UpdateCourseRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @var mixed|CourseRepository
     */
    public mixed $courses;

    /**
     * @param CourseRepository $courseRepository
     */
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courses = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse('ok', $this->courses->paginate());
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        return $this->successResponse('ok', $this->courses->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request, StoreCourseAction $action)
    {
        try {
            $dto = StoreCourseDTO::fromArray($request->validated());
            $response = $action->execute($dto);
            return $this->successResponse('Course created successfully.', $response);
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
    public function update(UpdateCourseRequest $request, Course $course, UpdateCourseAction $action)
    {
        try {
            $request->validated();
            $request->merge([
                'course' => $course
            ]);
            $dto = UpdateCourseDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return $this->successResponse('Course updated successfully.', $response);
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return $this->successResponse('Course deleted successfully');
    }
}
