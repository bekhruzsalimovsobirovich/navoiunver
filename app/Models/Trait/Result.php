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
        $results = $results->where('user_id', Auth::id())->load('answer');
        $controls = Control::whereIn('id', $results->pluck('control_id'))->get()->keyBy('id');
        $groupedByControl = $results->groupBy('control_id');

        foreach ($groupedByControl as $controlId => $results) {
            $count_correct = $results->filter(function ($result) {
                return $result->answer && $result->answer->correct;
            })->count();

            $count_incorrect = $results->count() - $count_correct;

            // Prepare the data for each control_id
            $rs[] = [
                'control_id' => $controlId,
                'control' => $controls[$controlId]->name ?? 'Unknown Control',
                'correct' => $count_correct,
                'incorrect' => $count_incorrect,
                'total' => $results->count(),
                'date' => Carbon::parse($results->first()->created_at)->format('Y-m-d')
            ];
        }

        return $rs;
    }
}
