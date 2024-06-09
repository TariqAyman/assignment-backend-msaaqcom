<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant
{
    use HasDomains;

    protected $fillable = [
        'name',
        'domain',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'domain',
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
