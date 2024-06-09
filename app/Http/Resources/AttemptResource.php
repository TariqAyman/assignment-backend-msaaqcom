<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttemptResource extends JsonResource
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
            'member' => new MemberResource($this->member),
            'quiz' => new QuizResource($this->quiz),
            'score' => $this->score,
            'answers' => AnswerResource::collection($this->whenLoaded('answers')),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
