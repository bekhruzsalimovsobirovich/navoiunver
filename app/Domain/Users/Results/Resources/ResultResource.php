<?php

namespace App\Domain\Users\Results\Resources;

use App\Domain\Admin\QuestionsAnswers\Models\Answer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//
//        return [
//            'student' => $this->user->firstname.' '.$this->user->lastname,
//            'correct' => $count_correct,
//            'incorrect' => $count_incorrect,
//            'total' => $count_correct + $count_incorrect,
//            'date' =>  Carbon::parse($this->created_at)->format('Y-m-d')
//        ];
    }
}
