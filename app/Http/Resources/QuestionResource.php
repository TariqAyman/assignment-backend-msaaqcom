<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'slug' => $this->slug,
            'question' => $this->question,
            'description' => $this->description,
            'type' => $this->type,
            'choices' => ChoiceResource::collection($this->whenLoaded('choices')),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
