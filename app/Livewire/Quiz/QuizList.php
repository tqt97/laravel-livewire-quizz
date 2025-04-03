<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Component;

class QuizList extends Component
{
    public function render()
    {
        $quizzes = Quiz::latest()->paginate();

        return view('livewire.quiz.index', compact('quizzes'));
    }

    public function delete(Quiz $quiz): void
    {
        abort_if(! auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quiz->delete();
    }
}
