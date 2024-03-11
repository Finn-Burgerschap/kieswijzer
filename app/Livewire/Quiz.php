<?php

namespace App\Livewire;

use App\Enums\OpinionType;
use App\Models\Party;
use App\Models\Question;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Quiz extends Component
{
    public int $question_count;

    public Question $current_question;

    public Collection $opinions_agree;

    public Collection $opinions_neutral;

    public Collection $opinions_disagree;

    public bool $more_info = false;

    public array $user_opinions = [];

    public bool $finished = false;

    public function mount(): void
    {
        $this->question_count = Question::count();
        $this->updateQuestion(1);

        Party::each(function ($party) {
            $this->user_opinions[$party->id] = [
                'name' => $party->name,
                'opinion' => 0,
            ];
        });
    }

    public function render(): View|Factory
    {
        return view('livewire.quiz');
    }

    public function changeMoreInfo(): void
    {
        $this->more_info = ! $this->more_info;
    }

    public function previousQuestion(): void
    {
        if ($this->current_question->order > 1) {
            $this->updateQuestion($this->current_question->order - 1);
        }
    }

    public function nextQuestion(): void
    {
        if ($this->current_question->order >= $this->question_count) {
            $this->finish();
            return;
        }

        $this->updateQuestion($this->current_question->order + 1);
    }

    public function giveOpinion(string $opinion): void
    {
        $opinion = OpinionType::from($opinion);
        match ($opinion) {
            OpinionType::Agree => $this->opinions_agree->each(function ($opinion) {
                $this->user_opinions[$opinion->party_id]['opinion'] += 1;
            }),
            OpinionType::Neutral => $this->opinions_neutral->each(function ($opinion) {
                $this->user_opinions[$opinion->party_id]['opinion'] += 1;
            }),
            OpinionType::Disagree => $this->opinions_disagree->each(function ($opinion) {
                $this->user_opinions[$opinion->party_id]['opinion'] += 1;
            }),
        };

        $this->nextQuestion();
    }

    public function finish(): void
    {
        usort($this->user_opinions, function ($a, $b) {
            return $b['opinion'] <=> $a['opinion'];
        });

        $this->finished = true;
    }

    private function updateQuestion(int $order): void
    {
        $this->current_question = Question::where('order', $order)->first();
        $this->opinions_agree = $this->current_question->opinions->where('opinion', OpinionType::Agree);
        $this->opinions_neutral = $this->current_question->opinions->where('opinion', OpinionType::Neutral);
        $this->opinions_disagree = $this->current_question->opinions->where('opinion', OpinionType::Disagree);
    }
}
