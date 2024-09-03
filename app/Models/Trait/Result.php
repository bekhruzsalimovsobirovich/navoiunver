<?php

namespace App\Models\Trait;

use App\Domain\Admin\Controls\Models\Control;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait Result
{
    public function result($results)
    {
        $rs = [];

// Load the related `answer` and `question` relationships
        $results = $results->where('user_id', Auth::id())->load(['answer', 'question']);

// Get controls keyed by `id`
        $controls = Control::whereIn('id', $results->pluck('control_id'))->get()->keyBy('id');

// Group the results by both `control_id` and `question.status`
        $groupedByControlAndStatus = $results->groupBy(['control_id', function ($item) {
            return $item->question->status; // Group by `question.status`
        }]);

        foreach ($groupedByControlAndStatus as $controlId => $resultsByStatus) {
            foreach ($resultsByStatus as $questionStatus => $results) {
                $count_correct = $results->filter(function ($result) {
                    return $result->answer && $result->answer->correct;
                })->count();

                $count_incorrect = $results->count() - $count_correct;

                // Prepare the data for each `control_id` and `question.status`
                $rs[$questionStatus] = [
                    'id' => $results->first()->id, // Assuming you want to take the first result's ID
                    'control_id' => $controlId,
                    'control' => $controls[$controlId]->name ?? 'Unknown Control',
                    'question_status' => $questionStatus,
                    'correct' => $count_correct,
                    'incorrect' => $count_incorrect,
                    'total' => $results->count(),
                    'date' => Carbon::parse($results->first()->created_at)->format('Y-m-d'),
                ];
            }
        }

        return $rs;


    }
}
