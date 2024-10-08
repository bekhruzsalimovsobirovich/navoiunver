<?php

namespace App\Domain\Admin\Lessons\Resources;

use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course' => $this->course,
            'course_plan' => $this->course_plan,
            'course_subject' => $this->course_subject,
            'date' => $this->date,
            'status' => $this->status,
            'files' => $this->files,
            'comments' => CommentResource::collection($this->comments)
        ];
    }
}
