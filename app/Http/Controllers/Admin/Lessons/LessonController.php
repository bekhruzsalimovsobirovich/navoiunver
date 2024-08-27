<?php

namespace App\Http\Controllers\Admin\Lessons;

use App\Domain\Admin\Lessons\Actions\StoreLessonAction;
use App\Domain\Admin\Lessons\Actions\UpdateLessonAction;
use App\Domain\Admin\Lessons\DTO\StoreLessonDTO;
use App\Domain\Admin\Lessons\DTO\UpdateLessonDTO;
use App\Domain\Admin\Lessons\Models\Lesson;
use App\Domain\Admin\Lessons\Repositories\LessonRepository;
use App\Domain\Admin\Lessons\Requests\StoreLessonRequest;
use App\Domain\Admin\Lessons\Requests\UpdateLessonRequest;
use App\Domain\Admin\Lessons\Resources\LessonResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
            return $this->successResponse('Lesson created successfully.', $response);
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
    public function update(UpdateLessonRequest $request, Lesson $lesson, UpdateLessonAction $action)
    {
        try {
            $request->validated();
            $request->merge([
                'lesson' => $lesson
            ]);
            $dto = UpdateLessonDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return $this->successResponse('Lesson updated successfully.', $response);
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        foreach ($lesson->files as $file){
            File::delete('storage/files/lessons/' . $file->filename);
        }
        \App\Domain\Admin\Files\Models\File::query()->where('fileable_id',$lesson->id)->delete();
        $lesson->delete();

        return $this->successResponse('Lesson deleted successfully.');
    }

    public function updateStatus(Lesson $lesson)
    {
        $lesson->status = !$lesson->status;
        $lesson->update();

        return $this->successResponse('Status updated successfully.');
    }


    public function createFileAndUpdate(Request $request, $lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);

        // Get the files from the request
        $filesData = $request->file('files'); // Assuming 'files' is an array of uploaded files
//        dd($request->all()['files']);
        // Loop through each file
        foreach ($request->all()['files'] as $fileData) {
            $fileId = $fileData['id'] ?? null; // Existing file id, if any
//            dd($fileId);
            // Check if it's an update or a new file
            if ($fileId) {
                // Update existing file
                $file =  \App\Domain\Admin\Files\Models\File::find($fileId);
                if ($file && $file->fileable_id == $lesson->id && $file->fileable_type == Lesson::class) {
                    // Handle file upload if a new file is provided
                    if (isset($fileData['file'])) {
                        File::delete('storage/files/lessons/' . $file->filename);
                        $filename = Str::random(6) . '_' . time() . '.' . $fileData['file']->getClientOriginalExtension();
                        $fileData['file']->storeAs('public/files/lessons', $filename);
                        $path = url('storage/files/lessons/' . $filename);
                        $file->update([
                            'filename' => $filename,
                            'path' => $path,
                            'type' => $fileData['type'],
                        ]);
                    } else {
                        // Update type or other details without changing the file
                        $file->update([
                            'type' => $fileData['type'],
                        ]);
                    }
                }
            } else {
                // Create a new file
                $filename = Str::random(6) . '_' . time() . '.' . $fileData['file']->getClientOriginalExtension();
                $fileData['file']->storeAs('public/files/lessons', $filename);
                $path = url('storage/files/lessons/' . $filename);
                $lesson->files()->create([
                    'filename' => $filename,
                    'path' => $path,
                    'type' => $fileData['type'],
                ]);
            }
        }

        return response()->json(['message' => 'Files saved successfully.']);
    }

}
