<?php

namespace App\Models;

use App\Enums\QuizType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\BelongsToTenant;

class Quiz extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => QuizType::class,
        ];
    }

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_quiz', 'quiz_id', 'member_id')->withPivot(['token']);
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class);
    }
}
