<?php

namespace App\Domain\Admin\QuestionsAnswers\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'name' => $this->name,
            'answers' => AnswerResource::collection($this->answersRandom),
            'active' => $this->active,
        ];
    }
}
