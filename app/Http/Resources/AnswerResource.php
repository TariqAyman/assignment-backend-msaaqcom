<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'correct_answers' => $this->correct_answers,
            'chosen_answers' => $this->chosen_answers,
            'is_correct' => $this->is_correct,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
