<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\TestAnswer;
use App\Models\User;

class ResultController extends Controller
{
    public function show(Test $test)
    {
        $users = null;

        $total_questions = $test->quiz->questions->count();

        $results = TestAnswer::where('test_id', $test->id)
            ->with('question.questionOptions')
            ->get();

        if ($test->quiz->public == 0) {
            $users = User::select('users.id', 'users.name', \DB::raw('sum(tests.result) as correct'), \DB::raw('sum(tests.time_spent) as time_spent'))
                ->join('tests', 'users.id', '=', 'tests.user_id')
                ->where('tests.quiz_id', $test->quiz_id)
                ->whereNotNull('tests.time_spent')
                ->groupBy('users.id', 'users.name')
                ->orderBy('correct', 'desc')
                ->orderBy('time_spent')
                ->get();
        }

        return view('front.results.show', compact('test', 'results', 'total_questions', 'users'));
    }
}
