<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\BelongsToTenant;

class Answer extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'attempt_id',
        'question_id',
        'member_id',
        'question',
        'is_correct',
        'chosen_answers',
        'correct_answers',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'chosen_answers' => 'array',
        'correct_answers' => 'array',
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(Attempt::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
