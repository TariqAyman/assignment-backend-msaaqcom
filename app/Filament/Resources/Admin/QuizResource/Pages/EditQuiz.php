<?php

namespace App\Filament\Resources\Admin\QuizResource\Pages;

use App\Enums\QuestionType;
use App\Filament\Resources\Admin\QuizResource;
use App\Helpers\SlugHelper;
use App\Models\Choice;
use App\Models\Question;
use App\Models\Quiz;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditQuiz extends EditRecord
{
    protected static string $resource = QuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data = parent::mutateFormDataBeforeFill($data);

        $data['questions'] = $this->record
            ->questions
            ->map(function (Question $question) {
                return [
                    'type' => $question->type,
                    'data' => [
                        'question' => $question->question,
                        'description' => $question->description,
                        'choices' => $this->getChoices($question->type, $question->choices),
                        'is_correct' => $this->checkIfQuestionIsCorrect($question),
                    ],
                ];
            })
            ->toArray();

        return $data;
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['slug'] = SlugHelper::generateUniqueSlug(Quiz::class, $data['title'], $record->id);

        $record->update($data);

        return $record;
    }

    private function checkIfQuestionIsCorrect(Question $question)
    {
        return $question->type == QuestionType::TRUE_FALSE ? $question?->choices?->first()?->is_correct : null; //  is_correct
    }

    private function getChoices($type, $choices)
    {
        return $choices->map(function (Choice $choice) use ($type) {
            $data = [
                'title' => $choice->title,
                'description' => $choice->description,
                'order' => $choice->order,
                'explanation' => $choice->explanation,
                'is_correct' => $choice->is_correct,
            ];

            if ($type == QuestionType::CHOICES) {
                return [
                    'type' => 'choice',
                    'data' => $data
                ];
            }

            return $data;
        })->toArray();
    }
}
