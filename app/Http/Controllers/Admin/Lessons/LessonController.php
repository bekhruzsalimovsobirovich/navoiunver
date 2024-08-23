<?php

namespace App\Http\Controllers\Admin\Lessons;

use App\Domain\Admin\Lessons\Actions\StoreLessonAction;
use App\Domain\Admin\Lessons\DTO\StoreLessonDTO;
use App\Domain\Admin\Lessons\Repositories\LessonRepository;
use App\Domain\Admin\Lessons\Requests\StoreLessonRequest;
use App\Domain\Admin\Lessons\Resources\LessonResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * @var mixed|LessonRepository
     */
    public mixed $lessons;

    /**
     * @param LessonRepository $lessonRepository
     */
    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessons = $lessonRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LessonResource::collection($this->lessons->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request, StoreLessonAction $action)
    {
        try {
            $dto = StoreLessonDTO::fromArray($request->validated());
            $response = $action->execute($dto);
//            return $this->successResponse('Lesson created successfully.', $response);
            return response()
                ->json([
                    'data' => $response,
                    'files' => $request->files
                ]);
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
