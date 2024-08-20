<?php

namespace App\Domain\Admin\Lessons\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'course' => $this->course->name,
            'course_plan' => $this->course_plan->name,
            'course_subject' => $this->course_subject->name,
            'date' => $this->date,
            'files' => $this->files,
        ];
    }
}
