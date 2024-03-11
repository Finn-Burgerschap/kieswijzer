<?php

namespace Database\Seeders;

use App\Enums\OpinionType;
use App\Models\Opinion;
use App\Models\Party;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $parties = json_decode(file_get_contents(__DIR__ . '/parties.json'), true);
        collect($parties)->each(fn ($party) => Party::create(collect($party)->except('slug')->toArray()));

        $questions = json_decode(file_get_contents(__DIR__ . '/questions.json'), true);
        foreach ($questions as $id => $question) {
            $question_model = Question::create([
                'order' => $id,
                'title' => $question['title'],
                'description' => $question['description'],
            ]);

            foreach ($question['opinions'] as $partyId => $opinion) {
                Opinion::create([
                    'question_id' => $question_model->id,
                    'party_id' => $partyId,
                    'opinion' => $opinion,
                    'description' => $this->generateDescription($opinion, $parties[$partyId]['slug']),
                ]);
            }
        }
    }

    private function generateDescription($opinionType, $partySlug): string
    {
        return match ($opinionType) {
            OpinionType::Agree => $partySlug . ' is het eens met dit standpunt.',
            OpinionType::Disagree => $partySlug . ' is het oneens met dit standpunt.',
            OpinionType::Neutral => $partySlug . ' is neutraal over dit standpunt.',
            default => 'Geen beschrijving beschikbaar.'
        };
    }
}
