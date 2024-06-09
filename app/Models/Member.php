<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use App\Trait\BelongsToTenant;

class Member extends Authenticatable implements FilamentUser, HasTenants, HasDefaultTenant
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, BelongsToTenant;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function quizzes(): BelongsToMany
    {
        return $this->belongsToMany(Quiz::class, 'member_quiz');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class);
    }

    /**
     * @throws \Exception
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() == 'member';
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function getDefaultTenant(Panel $panel): ?Model
    {
        return $this->tenant;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->tenant->id == $tenant->id;
    }

    public function getTenants(Panel $panel): array|Collection
    {
        return [$this->tenant];
    }
}
