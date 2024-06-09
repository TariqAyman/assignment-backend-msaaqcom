<?php

namespace App\Models;

use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\BelongsToTenant;

class Question extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'quiz_id',
        'question',
        'slug',
        'type',
        'description',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function isCorrectAnswer($answer)
    {
        if ($this->type === QuestionType::TEXT) {
            return null;
        }

        if ($this->type === QuestionType::TRUE_FALSE) {
            return $this->choices()->where('is_correct', 1)?->first()?->is_correct == $answer;
        }

        if ($this->type === QuestionType::CHOICES) {
            return $this->choices()->where('id', $answer)?->first()?->is_correct;
        }

        return null;
    }
}
