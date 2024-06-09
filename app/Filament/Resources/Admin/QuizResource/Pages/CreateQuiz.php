<?php

namespace App\Filament\Resources\Admin\QuizResource\Pages;

use App\Enums\QuestionType;
use App\Filament\Resources\Admin\QuizResource;
use App\Helpers\SlugHelper;
use App\Models\Question;
use App\Models\Quiz;
use App\Repositories\QuizRepository;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Filament\Facades\Filament;

class CreateQuiz extends CreateRecord
{
    protected static string $resource = QuizResource::class;

    protected string $tenantId;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = SlugHelper::generateUniqueSlug(Quiz::class, $data['title']);

        return $data;
    }

    public function create(bool $another = false): void
    {
        $this->tenantId = Filament::getTenant()?->id;

        DB::transaction(function () use ($another) {
            parent::create($another);
        });
    }

    /**
     * @throws \Exception
     */
    public function afterCreate(): void
    {
        $data = $this->form->getState();

        $questionsFromRequest = $data['questions'];

        foreach ($questionsFromRequest as $question) {
            match ($question['type']) {
                QuestionType::TEXT => $this->getQuizRepository()->saveTextQuestion($this->record, $question['data']),
                QuestionType::TRUE_FALSE => $this->getQuizRepository()->saveTrueFalseQuestion($this->record, $question['data']),
                QuestionType::CHOICES => $this->getQuizRepository()->saveChoicesQuestion($this->record, $question['data']),
                default => throw new \Exception('Unknown question type'),
            };
        }
    }

    private function getQuizRepository()
    {
        return app(QuizRepository::class);
    }
}
