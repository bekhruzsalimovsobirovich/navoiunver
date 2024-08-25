<?php

namespace App\Domain\Admin\QuestionsAnswers\Repositories;

use App\Domain\Admin\QuestionsAnswers\Models\Question;
use App\Domain\Admin\QuestionsAnswers\Resources\QuestionResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class QuestionAnswerRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return Question::query()
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll($control_id): Collection|array
    {
        $questions = Question::query()
            ->where('control_id',$control_id)
            ->inRandomOrder()
            ->get()
            ->groupBy('status');
        // Create a new array to store the grouped resources
        $groupedResources = [];

        foreach ($questions as $status => $questionsGroup) {
            $groupedResources[$status] = QuestionResource::collection($questionsGroup);
        }

        return $groupedResources;
    }
}
