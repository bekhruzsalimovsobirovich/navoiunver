<?php

namespace App\Http\Controllers\Admin\CourseSubjects;

use App\Domain\Admin\CourseSubjects\Actions\StoreCourseSubjectAction;
use App\Domain\Admin\CourseSubjects\Actions\UpdateCourseSubjectAction;
use App\Domain\Admin\CourseSubjects\DTO\StoreCourseSubjectDTO;
use App\Domain\Admin\CourseSubjects\DTO\UpdateCourseSubjectDTO;
use App\Domain\Admin\CourseSubjects\Models\CourseSubject;
use App\Domain\Admin\CourseSubjects\Repositories\CourseSubjectRepository;
use App\Domain\Admin\CourseSubjects\Requests\StoreCourseSubjectRequest;
use App\Domain\Admin\CourseSubjects\Requests\UpdateCourseSubjectRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CourseSubjectController extends Controller
{
    /**
     * @var mixed|CourseSubjectRepository
     */
    public mixed $course_subjects;

    /**
     * @param CourseSubjectRepository $courseSubjectRepository
     */
    public function __construct(CourseSubjectRepository $courseSubjectRepository)
    {
        $this->course_subjects = $courseSubjectRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse('ok', $this->course_subjects->paginate());
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        return $this->successResponse('ok', $this->course_subjects->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseSubjectRequest $request, StoreCourseSubjectAction $action)
    {
        try {
            $dto = StoreCourseSubjectDTO::fromArray($request->validated());
            $response = $action->execute($dto);
            return $this->successResponse('Course subject created successfully.', $response);
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
    public function update(UpdateCourseSubjectRequest $request, CourseSubject $course_subject, UpdateCourseSubjectAction $action)
    {
        try {
            $request->validated();
            $request->merge([
                'course_subject' => $course_subject
            ]);
            $dto = UpdateCourseSubjectDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return $this->successResponse('Course subject updated successfully.', $response);
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseSubject $course_subject)
    {
        $course_subject->delete();
        return $this->successResponse('Course subject deleted successfully');
    }
}
