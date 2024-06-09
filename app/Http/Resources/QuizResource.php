<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'questions' => QuestionResource::collection($this->whenLoaded('questions')),
            'is_member_subscribed' => $this->when($this->members()->where('member_id', $request->user()->id)->exists(), true, false),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
